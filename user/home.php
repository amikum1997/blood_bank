<?php
session_start();
require_once './php/handeler.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - MaterializeCSS Admin Dashboard [Responsive]</title>
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
	<ul id="dropdown1" class="dropdown-content">
		<li><a href="#!"><i class="material-icons">build</i>Account Settings</a></li>
		<li><a href="#!"><i class="material-icons">logout</i>Logout</a></li>
	</ul>
    <script>
$(document).ready(function () {
    $(".dropdown-trigger").dropdown();
    $('.sidenav').sidenav();
});
    </script>
	<div class="navbar-fixed">
		<nav class="colored">
		    <div class="nav-wrapper">
		    	<ul class="right hide-on-large-only show-on-medium-and-down">
		    		<li>
		    			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		    		</li>
		    	</ul>
		      	<ul class="right hide-on-med-and-down">
		        	<li><a><?php echo $row['userName']; ?></a></li>
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
				<li class="bordered"><a class="waves-effect" href="requestblood.php"><i class="material-icons">star</i>Request Blood</a></li>
				<li class="bordered"><a class="waves-effect" href="requeststatus.php"><i class="material-icons">star</i>Request Status</a></li>
				<li class="bordered"><a tabindex="-1" href="./php/logout.php" class="waves-effect"><i class="material-icons">logout</i>Logout</a></li>

			</ul>
		</div>
		<div class="container admin-content">
			<div class="col s12 m12 l9 offset-l3">
				<div class="hero-title">USER DETAILS</div>
				<div class="divider"></div>
				<div class="admin-content">
				<div class="col s12 m12 l8">
						<div class="card">
							<div class="card-content">
								<p>User Detail</p>
								<div class="divider"></div>
								<br>
								<div class="right-align">
									<table>
									<tr>
									<th>User Name :</th>
									<td><?php echo $row['userName']; ?></td>
									</tr>
									<tr>
									<th>User Email :</th>
									<td><?php echo $row['userEmail']; ?></td>
									</tr>
									<tr>
									<th>User Type :</th>
									<td><?php echo $row['userType']; ?></td>
									</tr>
									<tr>
									<th>User Blood Type :</th>
									<td><?php echo $row['userBloodGroup']; ?></td>
									</tr>

									</table>
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
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script><script  src="./script.js"></script>

</body>
</html>
