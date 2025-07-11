<?php
    namespace servicemanager;
    use PDO;
    use PDOException;
    class PaymentManager{
        private $pdo;
        public function __construct(PDO $pdo){
            $this->pdo = $pdo;
        }

        public function insertPayment($totalAmt,$customerId,$ref,$ordId):string|bool{
            try{
                $sql = "INSERT INTO payments SET payment_amount=?,payment_cusid=?,payment_ref=?,payment_orderid=?";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$totalAmt,$customerId,$ref,$ordId]);
                return $this->pdo->lastinsertId();
            }
            catch(PDOException $e){
                echo $e->getMessage(); 
                return false;
            }
        }

        public function paystack_initialize_step1($email,$totalAmt,$ref):object|bool{
            $url ="https://api.paystack.co/transaction/initialize";
            $fields = [
                'email' => $email,
                'amount' => $totalAmt*100,
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

        public function paystack_verify_step2($ref):object|bool{
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

        public function updatePayment($paystatus,$data,$ref):bool{
            try{
                $sql ="UPDATE payments SET payment_status=?,payment_data=? WHERE payment_ref=?";
                $stmt= $this->pdo->prepare($sql);
                $stmt->execute([$paystatus,$data,$ref]);
                return true;
            }catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        public function getPaidPayment():array|bool{
            try{
                $sql = "SELECT * FROM payments JOIN customers ON customers.customer_id= payments.payment_cusid WHERE payments.payment_status= 'paid' ";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
        public function PaymentDetailByCustomer($customerId):array|bool{
            try{
                $sql = "SELECT * FROM payments JOIN customers ON customers.customer_id= payments.payment_cusid WHERE payment_cusid=? ";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$customerId]);
                $data= $stmt->fetchAll(PDO::FETCH_OBJ);
                return $data;
            }
            catch(PDOException $e){
                return false;
            }
        }
    }
 

