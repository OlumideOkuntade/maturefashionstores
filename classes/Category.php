<?php
      declare(strict_types = 1);
      class Category {
            private  int $category_id;
            private string $category_name;

            public function __construct(int $Id, string $name)
            {     $this->category_id = $Id;
                  $this->category_name = $name;
                 
            }
            public function getCategoryId(): int {
                  return $this->category_id;
            }
            public function getCategoryName() : string {
                  return $this->category_name;
            }

      }


