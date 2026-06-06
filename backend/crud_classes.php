

<?php

class Branch
{

  public $table = 'branch';
  public $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read()
  {
    $query = "SELECT * FROM {$this->table}";
    $statement = $this->conn->prepare($query);
    $statement->execute();

    return $statement->fetchall(PDO::FETCH_ASSOC);
  }

  public function read_one($branch_id)
  {
    $query = "SELECT * FROM {$this->table} WHERE branch_id = :branch_id";
    $statement = $this->conn->prepare($query);
    $statement->bindParam(':branch_id', $branch_id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($branch_name, $branch_address, $branch_partner, $branch_phone)
  {
    $query = "INSERT INTO {$this->table} (branch_name , branch_address , branch_partner , branch_phone)
                     VALUES (:branch_name, :branch_address , :branch_partner , :branch_phone  )";
    $statement = $this->conn->prepare($query);
    $statement->execute([
      ':branch_name' => $branch_name,
      ':branch_address' => $branch_address,
      ':branch_partner' => $branch_partner,
      ':branch_phone' => $branch_phone
    ]);

    return $statement;
  }


  public function update($branch_name, $branch_address, $branch_partner, $branch_phone, $branch_id)
  {
    $query = "UPDATE {$this->table}     SET branch_name=:branch_name, branch_address=:branch_address ,
                                              branch_partner=:branch_partner , branch_phone =:branch_phone
                                              WHERE branch_id = :branch_id";
    $statement = $this->conn->prepare($query);
    $statement->execute([
      ':branch_name' => $branch_name,
      ':branch_address' => $branch_address,
      ':branch_partner' => $branch_partner,
      ':branch_phone' => $branch_phone,
      ':branch_id' => $branch_id
    ]);
    return $statement;
  }




  public function delete($branch_id)
  {
    $query = "DELETE FROM {$this->table} WHERE branch_id =:branch_id ";
    $statement = $this->conn->prepare($query);
    $statement->bindParam(':branch_id', $branch_id);
    $statement->execute();

    return $statement;
  }
}


class Send {

  public $table = 'send';
  public $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read(){
    $query = "SELECT {$this->table}.* , branch.branch_name 
               FROM {$this->table} 
               LEFT JOIN branch
               ON {$this->table}.send_to = branch.branch_id
               ORDER BY {$this->table}.send_id ASC

    ";
    $statement = $this->conn->prepare($query);
    $statement->execute();

    return $statement->fetchall(PDO::FETCH_ASSOC);
  }

  public function read_one($send_id)
  {
    $query = "SELECT * FROM {$this->table} WHERE branch_id = :send_id";
    $statement = $this->conn->prepare($query);
    $statement->bindParam(':send_id', $send_id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public function insert($that_reciever_name, $that_reciever_fatherName, $send_code, $send_amount, $send_date, $send_to)
  {
    $query = "INSERT INTO {$this->table} (that_reciever_name , that_reciever_fatherName , send_code , send_amount , send_date , send_to)
                     VALUES (:that_receiver_name , :that_receiver_fatherName , :send_code , :send_amount , :send_date , :send_to)";
    $statement = $this->conn->prepare($query);
    $statement->execute([
      ':that_receiver_name' => $that_reciever_name,
      'that_receiver_fatherName' => $that_reciever_fatherName,
      ':send_code' => $send_code,
      ':send_amount' => $send_amount,
      ':send_date' => $send_date,
      ':send_to' => $send_to
    ]);

    return $statement;
  }



  // public function update( $that_receiver_name , $that_receiver_fatherName, $send_code ,$send_amount , $send_date , $send_to ,$send_id){
  //   $query = "UPDATE {$this->table}     SET that_receiver_name=:that_receiver_name, that_receiver_fatherName= :that_receiver_fatherName ,
  //                                          send_code =:send_code , send_amount=:send_amount , send_date = :send_date , send_to =:send_to
  //                                       WHERE send_id = :send_id";
  //    $statement = $this-> conn -> prepare($query);

  //    $statement->execute([':that_receiver_name'=> $that_receiver_name , 'that_receiver_fatherName'=> $that_receiver_fatherName ,
  //                         ':send_code'=> $send_code , ':send_amount'=> $send_amount , ':send_date' => $send_date , ':send_to' =>$send_to , ':send_id'=>$send_id]) ;

  //    return $statement ; 
  // }

  // public function delete($send_id){
  //   $query = "DELETE FROM {$this->table} WHERE send_id =:send_id ";
  //   $statement = $this->conn->prepare($query);
  //   $statement -> bindParam(':send_id' , $send_id);
  //   $statement->execute();

  //   return $statement;

}

class Receive {

  public $conn;
  public $table = 'receive';

  public function __construct($db) {
    $this->conn = $db;
  }

  public function read() {
    $query = "SELECT {$this->table}.* , branch.branch_name
              FROM {$this->table}
              LEFT JOIN branch ON {$this->table}.receive_from = branch.branch_id
              ORDER BY {$this->table}.receiver_id ASC";
    $statement = $this->conn->prepare($query);
    $statement->execute();
    return $statement->FetchAll(PDO::FETCH_ASSOC);
  }

  public function insert($this_receiver_name, $this_receiver_fatherName, $receive_code, $receive_amount, $receive_date, $receive_from) {
    $query = "INSERT INTO {$this->table} (this_receiver_name , this_receiver_fatherName , receive_code , receive_amount , receive_date , receive_from , status)
                     VALUES (:this_receiver_name , :this_receiver_fatherName , :receive_code , :receive_amount , :receive_date , :receive_from , :status)";
    $statement = $this->conn->prepare($query);
    $statement->execute([
      ':this_receiver_name' => $this_receiver_name,
      ':this_receiver_fatherName' => $this_receiver_fatherName,
      ':receive_code' => $receive_code,
      ':receive_amount' => $receive_amount,
      ':receive_date' => $receive_date,
      ':receive_from' => $receive_from ,
      ':status' => "pending"
    ]);
    return $statement;
  }

  public function update($receive_id){
        $query = "UPDATE {$this->table} SET status = :status where receiver_id =:receive_id";
        $statement = $this->conn->prepare($query);
        
        $statement->execute([ ":status" => "paid" , ":receive_id" => $receive_id]);

        return $statement;
  }
  // public function delete(){
  // we are not going to delete important data especially about money
  // } 



     public function search_by_code($searched_code){

            $query = "SELECT {$this->table}.* , branch.branch_name
              FROM {$this->table}
              LEFT JOIN branch ON {$this->table}.receive_from = branch.branch_id
              WHERE {$this->table}.receive_code = :searched_code " ;

        $statement = $this->conn->prepare($query);

        $statement->execute([
            ':searched_code' => $searched_code
        ]);

      return $statement->fetch(PDO::FETCH_ASSOC);
  }


}


?>