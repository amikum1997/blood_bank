<?php
session_start();
require_once './php/handeler.php';

$auth_user = new HOSPITAL();

if($auth_user->is_logged_in()!="")
{
 $auth_user->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtupass']);
 
 if($auth_user->login($email,$upass))
 {
  $auth_user->redirect('home.php');
 }
}

if(isset($_POST['btn-signup']))
{
 $uname = trim($_POST['txtuname']);
 $email = trim($_POST['txtemail']);
 $upass = trim($_POST['txtpass']);
 $code = md5(uniqid(rand()));
 
 $stmt = $auth_user->runQuery("SELECT * FROM tbl_hospital WHERE userEmail=:email_id");
 $stmt->execute(array(":email_id"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
 if($stmt->rowCount() > 0)
 {
  $msg = " 
     <h2 style='color:red;'><strong>Sorry !</strong>  email allready exists , Please Try another one</h2>
     ";
 }
 else
 {
  if($auth_user->register($uname,$email,$upass,$code))
  {   
   $id = $auth_user->lasdID();  
   $key = base64_encode($id);
   $id = $key;
   
   $message = "     
      Hello $uname,
      <br /><br />
      Welcome to PhP Authentication Boilerplate Project!<br/>
      To complete your registration  please , just click following link<br/>
      <br /><br />
      <a href='http://localhost/auth/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
      <br /><br />
      Thanks,";
      
   $subject = "Confirm Registration";
      
   $auth_user->send_mail($email,$message,$subject); 
   $msg = "
     
     <h2> <strong>Success!</strong>  We've sent an email to $email.
     Please click on the confirmation link in the email to create your account. </h2>
       
     ";
  }
  else
  {
   echo "sorry , Query could no execute...";
  }  
 }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <title>HOSPITAL LOGIN</title>
</head>

<body>
    <section>
        <div class="nav" style="position: relative;">
            <ul>
                <li><a href="../index.php">Home</a></li>
            </ul>
        </div>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx">
                    <img src="./img/img2.jpg">
                </div>
                <div class="formBx">
                    <form method="post">
                    <div class="errorBx"><?php 
                    if(isset($_GET['inactive']))
                    {
                    ?>
                                
                        <h2 style='color:red;'><strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. </h2>
                    
                                <?php
                    }
                    ?>
                            <?php
                            if(isset($_GET['error']))
                    {
                    ?>
                                
                    <h2 style='color:red;'> <strong>Wrong Details!</strong> </h2>
                    
                                <?php
                    }
                    ?>
                     
                    </div>
                        <h2>Login</h2>
                        <input type="email" name="txtemail" placeholder="User Email">
                        <input type="password" name="txtupass" placeholder="User Password">
                        <p class="signup forgot">Forgot Password!!! <a href="Fpass.php">Recover.</a></p>
                        <input type="submit" name="btn-login" value="login">
                        <p class="signup">Dont Have An Account!!! <a href="#" onclick="toggleForm();">Sign Up.</a></p>
                       
                    </form>
                </div>
               
            </div>
            <!--Signup form-->
            <div class="user signupBx">
               
                <div class="formBx">
                    <form method="post">
                    <div class="errorBx"><?php if(isset($msg)) echo $msg;  ?></div>
                        <h2>Create Account</h2>
                        <input type="text" name="txtuname" placeholder="username">
                        <input type="email" name="txtemail" placeholder="user email">
                        <input type="password" name="txtpass" placeholder="User Password">
                        <input type="submit" name="btn-signup" value="Register">
                        <p class="signup">Already Have An Account!!! <a href="#" onclick="toggleForm();">Sign In.</a>
                        </p>
                    </form>
                </div>
                <div class="imgBx">
                   <img src="./img/img1.jpg">
                </div>
            </div>
        </div>
    </section>
    <script src="./js/form.js"></script>
</body>

</html>