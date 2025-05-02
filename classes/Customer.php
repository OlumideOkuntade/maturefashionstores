<?php
      class Customer {
            private  int $customer_id;
            private string $first_name;
            private string $last_name;
            private string $phone_number;
            private string $email;
            private string $password;
            private int $cus_stateid;

            public function __construct(int $Id, string $firstName, string $email, string $pass)
            {     $this->customer_id = $Id;
                  $this->first_name = $firstName;
                  $this->email= $email;
                  $this->password= $pass;
            }
            public function getCusId(): int {
                  return $this->customer_id;
            }
            public function getName() : string {
                  return $this->first_name;
            }
            public function getEmail() : string {
                  return $this->email;
            }
            public function getPassword() : string {
                  return $this->password;
            }
            public function getPhone() : string {
                  return $this->phone_number;
            }


      }


