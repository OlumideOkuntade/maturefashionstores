<?php
      declare(strict_types = 1);
      class Customer {
            private  int $customer_id;
            private string $first_name;
            private string $last_name;
            private string $phone_number;
            private string $email;
            private string $password;
            private int $cus_stateid;

            public function __construct(int $Id, string $firstName, string $lastName,string $email, string $pass,int $stateId)
            {     $this->customer_id = $Id;
                  $this->first_name = $firstName;
                  $this->last_name = $lastName;
                  $this->email= $email;
                  $this->password= $pass;
                  $this->cus_stateid= $stateId;
            }
            public function getCustomerId(): int {
                  return $this->customer_id;
            }
            public function getCustomerFirstName() : string {
                  return $this->first_name;
            }
            public function getCustomerLastName() : string {
                  return $this->last_name;
            }
            public function getCustomerEmail() : string {
                  return $this->email;
            }
            public function getCustomerPassword() : string {
                  return $this->password;
            }
            public function getCustomerPhoneNumber() : string {
                  return $this->phone_number;
            }
            public function getCustomerStateId() : int {
                  return $this->cus_stateid;
            }

      }


