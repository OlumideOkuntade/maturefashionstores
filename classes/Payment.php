<?php
    require_once "Db.php";
    class Payment extends Db{
        Private $db;
        Public function __construct(){
            $this->db = $this->connect();
        }

        public function checkcart($customerid){
            try{
                $sql = "SELECT cart_id FROM cart WHERE cart_userid =?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerid]);
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage(); 
            }
        }
        public function checkProduct($productid){
            try{
                $sql = "SELECT item_id FROM cartitem WHERE product_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$productid]);
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            } catch(PDOException $e){
                echo $e->getMessage();
                return false; 
            }
        }
        public function updateProduct($amt,$qty,$cartid,$productid){
                
            try{
                $sql = "UPDATE cartitem SET amount = amount + ? ,quantity = quantity + ? WHERE item_cartid=? AND product_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$amt,$qty,$cartid,$productid]);
                $data= $stmt->fetch(PDO::FETCH_ASSOC);
                return true;
            } catch(PDOException $e){
                echo $e->getMessage(); 
            }
        }

        public function insertcart($customerid){
            try{
                $sql = "INSERT INTO cart SET cart_userid = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerid]);
                $data = $this->db->lastInsertId();
                return $data;
            } 
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function insertcartitem($qty,$customerid,$productid,$cartid,$amt){
            try{
                $sql = "INSERT INTO cartitem SET quantity=?,user_id=?,product_id=?,item_cartid =?,amount=?";
                $stmt = $this->db->prepare($sql);
                $data= $stmt->execute([$qty,$customerid,$productid,$cartid,$amt]);
                if($data){
                    return true;
                    exit;
                }else{
                    return false;
                    exit;
                };
            }
            catch(PDOException $e){
                echo $e->getMessage();
                // return false;
            }
        }
        
        public function getcartitem($customerid){
            try{
                $sql = "SELECT products.product_id,products.product_image,products.product_name,products.product_price,cartitem.quantity,cartitem.amount FROM cartitem JOIN products ON products.product_id= cartitem.product_id WHERE cartitem.user_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerid]);
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                
            }        
        }

        public function totalamt($customerid){
            try{
                $sql = "SELECT sum(amount) AS totalamt from cartitem WHERE cartitem.user_id=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$customerid]);
                $data= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                
            }         
        }

       public function deletecart($id,$customerid){
        try{
            $sql = "DELETE from cartitem WHERE cartitem.product_id=? AND cartitem.user_id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id,$customerid]);
            $data= $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            
        } 

       }
       public function deleteall($customerid){
        try{
            $sql = "DELETE from cartitem WHERE cartitem.user_id=?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$customerid]);
            $data= $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            
        } 
       }
        
        public function insertOrder($total,$customerid,$size,$productid){
            try{
                $sql = "INSERT INTO orders SET order_amount=?,order_customerID =?,order_size=?,order_productid=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$total,$customerid,$size,$productid]);
                $data = $this->db->lastInsertId();
                return $data;
            }catch(Exception $e){
                echo $e->getMessage();
                // return false;
            }
        }

        public function orderbyId($id){
            try{
                $sql ="SELECT * FROM orders JOIN products ON order_productid=product_id WHERE order_id =?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                return $data;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }

        public function insertPayment($totalamt,$customerid,$ref,$ordId){
            try{
                $sql = "INSERT INTO payment SET payment_amount=?,payment_cusid=?,payment_ref=?,payment_orderid=?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$totalamt,$customerid,$ref,$ordId]);
                return $this->db->lastinsertId();
            }
            catch(Exception $e){
                echo $e->getMessage(); 
            }
        }




        public function paystack_initialize_step1($email,$totalamt,$ref){
            $url ="https://api.paystack.co/transaction/initialize";
            $fields = [
                'email' => $email,
                'amount' => $totalamt*100,
                'reference'=> $ref,
                'callback_url' => "http://localhost/maturedFashion/paystack_landing.php"
              ];
            $headers =['Content-Type: application/json','Authorization: Bearer sk_test_256d10e136606fc3c89d7a4ffdf7c6562ba4d880'];
            //   step 1 initialize
            $curlobj = curl_init($url);
            #step 2 set options
            curl_setopt($curlobj, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curlobj, CURLOPT_POSTFIELDS,json_encode($fields));
            curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlobj, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);
            #step 3 execute and receive response
            $apirsp = curl_exec($curlobj);
            if($apirsp){
                curl_close($curlobj);
                return json_decode($apirsp);
            }else{
                $r = curl_error($curlobj);
                return false;
            }
        }

        public function paystack_verify_step2($ref){
            // die($ref);
            $url ="https://api.paystack.co/transaction/verify/$ref";
            $headers =['Content-Type: application/json','Authorization: Bearer sk_test_256d10e136606fc3c89d7a4ffdf7c6562ba4d880'];
            //   step 1 initialize
            $curlobj = curl_init($url);
            curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlobj, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, false);
            #step 3 execute and receive response
            $apirsp = curl_exec($curlobj);
            #step 4&5
            if($apirsp){
            curl_close($curlobj);
            return json_decode($apirsp);
            }else{
            $r = curl_error($curlobj);
            return false;
            }      
 
        }

        public function updatePayment($paystatus,$data,$ref){
            try{
                $sql ="UPDATE payment SET payment_status=?,payment_data=? WHERE payment_ref=?";
                $stmt= $this->db->prepare($sql);
                $stmt->execute([$paystatus,$data,$ref]);
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }


    }
    // $pay = new payment;
    // $res = $pay->checkProduct(1,4);
    // echo "<pre>";
    // echo print_r($res['item_id']);
    // echo "</pre>";
    

?>