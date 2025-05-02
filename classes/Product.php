<?php
      class Product {
            private  int $product_id;
            private string $product_name;
            private string $product_price;
            private string $product_qauntity;
            private string $product_status;
            private int $product_categoryid;

            public function __construct(int $Id, string $name, string $price, string $qty, string $status)
            {     $this->product_id = $Id;
                  $this->product_name = $name;
                  $this->product_price= $price;
                  $this->product_qauntity= $qty;
                  $this->product_status = $status;
            }
            public function getId(): int {
                  return $this->product_id;
            }
            public function getName() : string {
                  return $this->product_name;
            }
            public function getPrice() : string {
                  return $this->product_price;
            }
            public function getQuantity() : string {
                  return $this->product_qauntity;
            }
            public function getStatus() :string {
                  return $this->product_status;
            }

      }


