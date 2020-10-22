<?php
session_start();
require_once './php/handeler.php';
require_once './php/dashboard.php';

$user_home = new HOSPITAL();
$dashboard = new DASHBOARD();
if(!$user_home->is_logged_in())
{
 $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_hospital WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['hospitalSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{
    $hname = $row['hospitalName'];
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $bgroup = trim($_POST['bgroup']);
    $sex = trim($_POST['sex']);
    $phnum = trim($_POST['phnum']);
    $address = trim($_POST['address']);
    if($dashboard->addblood($hname,$fname,$lname,$bgroup,$sex,$phnum,$address))
    {
        echo '<script type="text/javascript">alert("Record Updated")</script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons|Poppins'><link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="initial-scale=1, minimum-scale=1, width=device-width" name="viewport">
	<meta name="robots" content="all,follow">
	<title>Dashboard - Application</title>
</head>
<body>
	<div class="navbar-fixed">
		<nav class="colored">
		    <div class="nav-wrapper">
		    	<ul class="right hide-on-large-only show-on-medium-and-down">
		    		<li>
		    			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		    		</li>
		    	</ul>
		      	<ul class="right hide-on-med-and-down">
		        	<li><?php echo $row['hospitalName']; ?></li>
			    </ul>
		    </div>
		</nav>
	</div>
	<div class="row">
		<div class="col s12 m12 l3">
			<ul id="slide-out" class="sidenav sidenav-fixed sidebar-clear-parent">
				<li class="sidebar-clear"></li>
				<li class="img-thumb valign-wrapper">
					<img src="./img/avatar.svg" class="circle" alt="" height="100px">
				</li>
				<li class="bordered"><a class="waves-effect" href="home.php"><i class="material-icons">dashboard</i>Dashboard</a></li>
				<li class="bordered"><a class="waves-effect" href="addBlood.php"><i class="material-icons">star</i>Add Blood</a></li>
				<li class="bordered"><a class="waves-effect" href="bloodStock.php"><i class="material-icons">storage</i>Blood Stock</a></li>
				<li class="bordered"><a class="waves-effect" href="bloodRequest.php"><i class="material-icons">storage</i>Blood Request</a></li>
				<li class="bordered"><a tabindex="-1" href="./php/logout.php" class="waves-effect"><i class="material-icons">logout</i>Logout</a></li>
			</ul>
		</div>
		<div class="container admin-content">
			<div class="col s12 m12 l9 offset-l3">
				<div class="hero-title">ADD BLOOD RECORD</div>
				<div class="divider"></div>
				<div class="admin-content">
			
                    <div class="col s12 m12 20">
						<div class="card">
							<div class="card-content">
								<p>FILL ALL DETAILS CAREFULLY</p>
								<div class="divider"></div>
								<br>
								<div class="left-align">
                                <div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" name="fname" class="validate" required/>
          <label for="first_name">Donor First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" type="text" name="lname" class="validate" required />
          <label for="last_name">Donor Last Name</label>
        </div>
      </div>
     <div class="row">
     <div class="col s6">
     <label>BLOOD GROUP</label>
  <select class="browser-default" name="bgroup" >
    <option value="" disabled selected>Choose your option</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
  </select>
     </div>
     <div class="col s6">
     <label>DONOR SEX</label>
  <select class="browser-default" name="sex">
    <option value="" disabled selected>Choose your option</option>
    <option value="male">MALE</option>
    <option value="female">FEMALE</option>
    <option value="others">OTHERS</option>
  </select>
     </div>
     </div>
     <div class="row">
     <div class="input-field col s6">
          <i class="material-icons prefix">phone</i>
          <input id="icon_telephone" type="number" name="phnum" class="validate" required/>
          <label for="icon_telephone">Telephone</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" name="address" class="materialize-textarea" required></textarea>
          <label for="textarea1">DONER ADDRESS</label>
        </div>
      </div>
      <button class="btn waves-effect waves-light" type="submit" name="submit">Submit
    <i class="material-icons right">send</i>
  </button>
    </form>
  </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<!-- partial -->
<script src="./js/dashboard.js">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script><script  src="./script.js"></script>

</body>
</html>
