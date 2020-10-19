<?php
require_once './php/handeler.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
 $user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
 $id = base64_decode($_GET['id']);
 $code = $_GET['code'];
 
 $statusY = "Y";
 $statusN = "N";
 
 $stmt = $user->runQuery("SELECT userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
 $stmt->execute(array(":uID"=>$id,":code"=>$code));
 $row=$stmt->fetch(PDO::FETCH_ASSOC);
 if($stmt->rowCount() > 0)
 {
  if($row['userStatus']==$statusN)
  {
   $stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status WHERE userID=:uID");
   $stmt->bindparam(":status",$statusY);
   $stmt->bindparam(":uID",$id);
   $stmt->execute(); 
   
   $msg = "    
       <strong>WoW !</strong>  Your Account is Now Activated : <a href='index.php'>Login here</a>
        
          "; 
  }
  else
  {
   $msg = "     
       <strong>sorry !</strong>  Your Account is allready Activated : <a href='index.php'>Login here</a>
          ";
  }
 }
 else
 {
  $msg = " 
      <strong>sorry !</strong>  No Account Found : <a href='index.php'>Signup here</a>
      ";
 } 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>Login Registration Boilerplate</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx">
                    <img src="./img/img2.jpg">
                </div>
                <div class="formBx">
                    <h2><?php if(isset($msg)) { echo $msg; } ?>.</h2>
                </div>
                <div class="errorBx"></div>
            </div>
        </div>
    </section>
    <script src="./js/form.js"></script>
</body>

</html>