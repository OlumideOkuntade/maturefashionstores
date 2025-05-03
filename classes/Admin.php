<?php
      declare(strict_types = 1);
      class Admin {
            private  int $admin_id;
            private string $admin_username;
            private string $admin_pwd;
            private DateTime $admin_loggedin;
          
            public function __construct(int $Id, string $name, string $pwd, DateTime $log)
            {     $this->admin_id = $Id;
                  $this->admin_username = $name;
                  $this->admin_pwd= $pwd;
                  $this->admin_loggedin= $log;
            }
            public function getAdminId(): int {
                  return $this->admin_id;
            }
            public function getAdminName() : string {
                  return $this->admin_username;
            }
            public function getAdminPassword() : string {
                  return $this->admin_pwd;
            }
            public function getAdminLoggedIn() : DateTime {
                  return $this->admin_loggedin;
            }
          
      }


