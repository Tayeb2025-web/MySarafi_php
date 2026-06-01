

<?php

  class Branch {
    
        public $branch_id;
        public $branch_name;
        public $branch_address;
        public $branch_partner;
        public $branch_phone;
        public $table = 'branch' ;
        public $conn;

         public function __construct($db) {
           $this->conn = $db;
           }

        public function read() {
          $query = "SELECT * FROM {$this->table}";
          $statement = $this->conn->prepare($query);
          $statement->execute();

          return $statement->fetchall(PDO::FETCH_ASSOC);
        }

        public function read_one(){
          
        }

        public function insert($branch_name , $branch_address, $branch_partner ,$branch_phone  ){
           $query = "INSERT INTO {$this->table} (branch_name , branch_address , branch_partner , branch_phone)
                     VALUES (':branch_name' , ':branch_address' , ':branch_partner' , ':branch_phone'  )";
          $statement = $this->conn->prepare($query);
           $statement->execute([':branch_name'=>$branch_name , ':branch_address'=>$branch_address , ':branch_partner'=>$branch_partner ,
                               ':branch_phone'=>$branch_phone]) ;
        
          return $statement;
        }

        public function update(){
          
        }

        public function delete($branch_id){
          $query = "DELETE FROM {$this->table} WHERE branch_id =:branch_id ";
          $statement = $this->conn->prepare($query);
          $statement -> bindParam(':branch_id' , $branch_id);
          $statement->execute();

          return $statement;
          
        }

 }

?>