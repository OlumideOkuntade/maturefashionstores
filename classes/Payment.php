<?php
      declare(strict_types = 1);
      class Payment {
            private  int $payment_id;
            private DateTime $payment_date;
            private string $payment_amount;
            private string $payment_status;
            private string $payment_ref;
            private int $payment_cusId;
            private int $payment_orderId;
            private string $payment_data;
            

            public function __construct(int $Id, DateTime $date, string $amt, string $status, string $ref, int $cusId, int $ordId, string $data)
            {     $this->payment_id = $Id;
                  $this->payment_date = $date;
                  $this->payment_amount= $amt;
                  $this->payment_status= $status;
                  $this->payment_ref = $ref;
                  $this->payment_cusId = $cusId;
                  $this->payment_orderId = $ordId;
                  $this->payment_data = $data;
            }
            public function getPaymentId(): int {
                  return $this->payment_id;
            }
            public function getPaymentDate() : DateTime {
                  return $this->payment_date;
            }
            public function getPaymentAmount() : string {
                  return $this->payment_amount;
            }
            public function getPaymentStatus() : string {
                  return $this->payment_status;
            }
            public function getPaymentRef() : string {
                  return $this->payment_ref;
            }
            public function getPaymentCustomerId() : int {
                  return $this->payment_cusId;
            }
            public function getPaymentOrderId() : int {
                  return $this->payment_orderId;
            }
            public function getPaymentData() : string {
                  return $this->payment_data;
            }

      }


