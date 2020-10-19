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
 
 $stmt = $user->runQuery("SELECT * FROM tbl_users WHERE userID=:uid AND tokenCode=:token");
 $stmt->execute(array(":uid"=>$id,":token"=>$code));
 $rows = $stmt->fetch(PDO::FETCH_ASSOC);
 
 if($stmt->rowCount() == 1)
 {
  if(isset($_POST['btn-reset-pass']))
  {
   $pass = $_POST['pass'];
   $cpass = $_POST['confirm-pass'];
   
   if($cpass!==$pass)
   {
    $msg = "
      <h2><strong>Sorry!</strong>  Password Doesn't match.</h2> 
      ";
   }
   else
   {
    $stmt = $user->runQuery("UPDATE tbl_users SET userPass=:upass WHERE userID=:uid");
    $stmt->execute(array(":upass"=>$cpass,":uid"=>$rows['userID']));
    
    $msg = "
     <h2> Password Changed.</h2>
     ";
    header("refresh:5;index.php");
   }
  } 
 }
 else
 {
  exit;
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
                    <img src="./img/img3.jpg">
                </div>
                <div class="formBx">
                    <form>
                        <h2>Reset Password</h2>
                        <input type="password" name="pass" placeholder="New Password">
                        <input type="password" name="confirm-pass" placeholder="Confirm Password">
                        <input type="submit" name="btn-reset-pass" value="Reset">
                        <p class="signup">So We Can Start Again!!! <a href="index.php">Login Here.</a>
                        </p>
                    </form>
                </div>
                <div class="errorBx"><?php
        if(isset($msg))
  {
   echo $msg;
  }
  ?></div>
            </div>
        </div>
    </section>
    <script src="./js/form.js"></script>
</body>

</html>