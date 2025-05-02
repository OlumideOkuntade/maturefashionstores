<?php
      class Order {
            private  int $order_id;
            private string $order_amount;
            private string $order_size;
            private DateTime $order_date;
            private int $order_customerId;
            private int $order_productId;

            public function __construct(int $Id, string $amt, string $size, DateTime $date)
            {     $this->order_id = $Id;
                  $this->order_amount = $amt;
                  $this->order_size= $size;
                  $this->order_date= $date;
            }
            public function getId(): int {
                  return $this->order_id;
            }
            public function getAmt() : string {
                  return $this->order_amount;
            }
            public function getSize() : string {
                  return $this->order_size;
            }
            public function getDate() : DateTime {
                  return $this->order_date;
            }


      }


