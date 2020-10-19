<?php

require_once 'connection.php';

class DASHBOARD{
    private $conn;

    public function __construct()
    {
     $database = new Database();
     $db = $database->dbConnection();
     $this->conn = $db;
   }
    
    public function runQuery($sql)
    {
     $stmt = $this->conn->prepare($sql);
     return $stmt;
    }
 
    public function addblood($hname,$fname,$lname,$bgroup,$sex,$phnum,$address)
    {
        try
        {
            $stmt = $this->conn->prepare("INSERT INTO blood_doner_record(hospitalName,donerName,donerBloodGroup,donerSex,donerPhNo,donerAddress) 
            VALUES(:hospital_name,:doner_name, :doner_group, :doner_sex,:doner_phno, :doner_address)");
            $stmt->bindparam(":hospital_name",$hname);
            $stmt->bindparam(":doner_name",$fname);
            $stmt->bindparam(":doner_group",$bgroup);
            $stmt->bindparam(":doner_sex",$sex);
            $stmt->bindparam(":doner_phno",$phnum);
            $stmt->bindparam(":doner_address",$address);
            $stmt->execute(); 
            return $stmt;
        }
        catch(PDOException $ex)
        {
         echo $ex->getMessage();
        }
    }
}

?>