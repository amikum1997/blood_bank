
<?php
session_start();
require_once './php/handeler.php';
$user = new HOSPITAL();

if($user->is_logged_in()!="")
{
 $user->redirect('home.php');
}

if(isset($_POST['btn-submit']))
{
 $email = $_POST['txtemail'];
 
 $stmt = $user->runQuery("SELECT userID FROM tbl_hospital WHERE userEmail=:email LIMIT 1");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  $id = base64_encode($row['userID']);
  $code = md5(uniqid(rand()));
  
  $stmt = $user->runQuery("UPDATE tbl_hospital SET tokenCode=:token WHERE userEmail=:email");
  $stmt->execute(array(":token"=>$code,"email"=>$email));
  
  $message= "
       Hello , $email
       <br /><br />
       We got requested to reset your password, if you do this then just click the following link to reset your password, if not just ignore                   this email,
       <br /><br />
       Click Following Link To Reset Your Password 
       <br /><br />
       <a href='http://localhost/auth/resetpass.php?id=$id&code=$code'>click here to reset your password</a>
       <br /><br />
       thank you :)
       ";
  $subject = "Password Reset";
  
  $user->send_mail($email,$message,$subject);
  
  $msg = "
     We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
     ";
 }
 else
 {
  $msg = "
     <strong>Sorry!</strong>  this email not found. 
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
    <title>FORGOT PASSWORD</title>
</head>

<body>

    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx">
                    <img src="./img/img1.jpg">
                </div>
                <div class="formBx">
                    <form>
                        <h2>Forgot Password</h2>
                        <input type="email" name="txtemail" placeholder="User Email">
                        <input type="submit" name="btn-submit" value="Recover">
                        <p class="signup">Remember Your Password!!! <a href="index.php">Login Here.</a></p>
                    </form>
                </div>
                <div class="errorBx"><?php
   if(isset($msg))
   {
    echo $msg;
   }
   ?>
   </div>
            </div>
        </div>
    </section>
    <script src="./js/form.js"></script>
</body>

</html>