<?php
      class Cart {
            private  int $item_id;
            private int $user_id;
            private int $product_id;
            private int $item_cartid;
            private string $quantity;
            private string $amount;
           

            public function __construct(int $Id, int $userId, int $proId, string $qty, string $amt)
            {     $this->item_id = $Id;
                  $this->user_id = $userId;
                  $this->product_id= $proId;
                  $this->quantity= $qty;
                  $this->amount= $amt;
            }
            public function getId(): int {
                  return $this->item_id;
            }
            public function getUserId() : int {
                  return $this->user_id;
            }
            public function getProId() : int {
                  return $this->product_id;
            }
            public function getQty() : string {
                  return $this->quantity;
            }
            public function getAmt() : string {
                  return $this->amount;
            }
          


      }


