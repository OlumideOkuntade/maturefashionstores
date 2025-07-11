<?php
      declare(strict_types = 1);
      namespace classes;
      class Product {
            private  int $product_id;
            private string $product_name;
            private string $product_price;
            private string $product_qauntity;
            private string $product_status;
            private int $product_categoryId;

            public function __construct(int $Id, string $name, string $price, string $qty, string $status, int $catId)
            {     $this->product_id = $Id;
                  $this->product_name = $name;
                  $this->product_price= $price;
                  $this->product_qauntity= $qty;
                  $this->product_status = $status;
                  $this->product_categoryId = $catId;
            }
            public function getProductId(): int {
                  return $this->product_id;
            }
            public function getProductName() : string {
                  return $this->product_name;
            }
            public function getProductPrice() : string {
                  return $this->product_price;
            }
            public function getProductQuantity() : string {
                  return $this->product_qauntity;
            }
            public function getProductStatus() : string {
                  return $this->product_status;
            }
            public function getProductCategoryId() : int {
                  return $this->product_categoryId;
            }

      }


