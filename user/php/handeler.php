<?php

require_once 'connection.php';

class USER
{ 

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
 
 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }
 
 public function register($uname,$email,$upass,$bgroup,$code)
 {
  try
  {       
   $userType="user";
   $password = md5($upass);
   $stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,userType,userBloodGroup,tokenCode) 
                                                VALUES(:user_name, :user_mail, :user_pass,:user_type,:user_blood, :active_code)");
   $stmt->bindparam(":user_name",$uname);
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":user_type",$userType);
   $stmt->bindparam(":user_blood",$bgroup);
   $stmt->bindparam(":active_code",$code);
   $stmt->execute(); 
   return $stmt;
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 public function login($email,$upass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   
   if($stmt->rowCount() == 1)
   {
    if($userRow['userStatus']=="N")
    {
     if($userRow['userPass']==md5($upass))
     {
      $_SESSION['userSession'] = $userRow['userID'];
      return true;
     }
     else
     {
      header("Location: index.php?error");
      exit;
     }
    }
    else
    {
     header("Location: index.php?inactive");
     exit;
    } 
   }
   else
   {
    header("Location: index.php?error");
    exit;
   }  
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 
 public function is_logged_in()
 {
  if(isset($_SESSION['userSession']))
  {
   return true;
  }
 }
 
 public function redirect($url)
 {
  header("Location: $url");
 }
 
 public function logout()
 {
  session_destroy();
  $_SESSION['userSession'] = false;
 }
 
 function send_mail($email,$message,$subject)
 {      
  mail($email,$subject,$message);
 } 

 function requestblood($requesterName,$hospitalName,$requestedBloodGroup)
 {
try{
  $stmt = $this->conn->prepare("INSERT INTO blood_request(hospitalName,requesterName,requesterBloodGroup) 
  VALUES(:user_name, :hospital, :bloodgroup)");
$stmt->bindparam(":user_name",$requesterName);
$stmt->bindparam(":hospital",$hospitalName);
$stmt->bindparam(":bloodgroup",$requestedBloodGroup);
$stmt->execute(); 
return $stmt;
}

catch(PDOException $ex)
{
echo $ex->getMessage();
}
 }
}