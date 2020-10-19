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
  <title>Dashboard</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons|Poppins'><link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="./css/dashboard.css">
</head>
<body>
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
	<div class="navbar-fixed">
		<nav class="colored">
		    <div class="nav-wrapper">
		    	<ul class="right hide-on-large-only show-on-medium-and-down">
		    		<li>
		    			<a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
		    		</li>
		    	</ul>
		      	<ul class="right hide-on-med-and-down">
		        	<li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><?php echo $row['userName']; ?></a></li>
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
				<div class="hero-title">BLOOD AVILABLE</div>
				<div class="divider"></div>
				<div class="admin-content">
                    <div class="col s12 m12 20">
						<div class="card">
							<div class="card-content">
								<p>REQUEST HISTORY</p>
								<div class="divider"></div>
								<br>
								<div class="right-align">
                                <table class="striped">
                                <thead>
                                <tr>
                                    <th>REQUESTED FROM</th>
                                    <th>REQUESTED BLOOD GROUP</th>
                                    <th>REQUESTED ON</th>
                                </tr>
                                </thead>
								
                                <tbody>
								<?php
								// fetch all records form blood_request
				
									$sql = $user_home->runQuery("SELECT * FROM blood_request WHERE hospitalName=:rname");
									$sql->execute(array(":rname"=>$row["userName"]));
									if($sql->rowCount() > 0)
									{
									while($result = $sql->fetch(PDO::FETCH_ASSOC))
									{
										?>
										<tr>
                                    <td><?php echo $result['hospitalName']; ?></td>
                                    <td><?php echo $result['requesterBloodGroup']; ?></td>
                                    <td><?php echo $result['requestDate']; ?></td>
                                 
                                </tr>
										<?php
									}
								}
								else{
									echo"No Record Found";
								}
									
								?>
                                </tbody>
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
<script src="./js/dashboard.js">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script><script  src="./script.js"></script>

</body>
</html>
