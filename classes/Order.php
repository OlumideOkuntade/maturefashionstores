<?php
      declare(strict_types = 1);
      class Order {
            private  int $order_id;
            private string $order_amount;
            private string $order_size;
            private DateTime|string $order_date;
            private int $order_customerId;
            private int $order_productId;

            // public function __construct(int $Id = 0, string $amt= '0', string $size ='', DateTime|string $date = '',int $ordId = 0, int $prodId = 0)
            // {     $this->order_id = $Id;
            //       $this->order_amount = $amt;
            //       $this->order_size= $size;
            //       $this->order_date= $date;
            //       $this->order_customerId= $ordId;
            //       $this->order_productId= $prodId;
            // }
            public function getOrderId(): int {
                  return $this->order_id;
            }
            public function getOrderAmt() : string {
                  return $this->order_amount;
            }
            public function getOrderSize() : string {
                  return $this->order_size;
            }
            public function getOrderDate() : DateTime {
                  return $this->order_date;
            }
            public function getOrderCustomerId() : int{
                  return $this->order_customerId;
            }
            public function getOrderProductId() : int{
                  return $this->order_productId;
            }


      }


