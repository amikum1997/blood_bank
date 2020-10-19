<?php
session_start();
require_once './php/handeler.php';
$user_home = new USER();


	
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Request Blood</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons|Poppins'>
<link rel="stylesheet" href="./assets/css/request.css">
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
	<title>REQUEST BLOOD</title>
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
				  <li><a href="../index.php">Home</a></li>
                    <li><a href="index.php" ><?php 
                    if(!$user_home->is_logged_in())
                    {
                     echo "Please Login In To Create Request";
                    }
                    else
                    {
						$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
						$stmt->execute(array(":uid"=>$_SESSION['userSession']));
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo "Logged in as : ";
                        echo $row["userName"];
                    }
                    
                    ?></a></li>
			    </ul>
		    </div>
		</nav>
	</div>
    <div class="container admin-content">
			<div class="col s12 m12 l9 offset-l3">
				<div class="admin-content">
					<div class="col s12 m12 20">
						<div class="card">
							<div class="card-content">
								<p>AVAILABLE BLOOD FROM ALL REGISTERED HOSPITALS</p>
								<div class="divider"></div>
								<br>
								<table>
								<thead>
								<tr>
									<th>HOSPITAL NAME</th>
									<th>BLOOD GROUP</th>
									<th>REQUEST NOW</th>
								</tr>
								</thead>

								<tbody>
								<?php
								// fetch all records form blood_doner_record
									$sql = $user_home->runQuery("SELECT * FROM blood_doner_record");
									$sql->execute(array());
									if($sql->rowCount() > 0)
									{
									while($result = $sql->fetch(PDO::FETCH_ASSOC))
									{
										?>
										<tr>
                                    <td><?php echo $result['hospitalName']; ?></td>
                                    <td><?php echo $result['donerBloodGroup']; ?></td>
                                    <td> <form method="POST" action="requestblood.php">
									<input type="hidden" name="hospitalname" value="<?php echo $result["hospitalName"]; ?>" >
									<input type="hidden" name="username" value="<?php echo $row["userName"]; ?>" >
									<input type="hidden" name="bloodgroup" value="<?php echo $result["donerBloodGroup"]; ?>" >
									<button class="btn waves-effect waves-light" type="submit" name="request">Request Sample
									<i class="material-icons right">send</i>
									</button>
									</form>
									
									</td>
                                    </tr>
								     <?php
									}
								}
								else{
									echo "No Record Found";
								}
								
									
								?>
								<?php
									if(isset($_POST['request']))
									{
										
												if($user_home->is_logged_in())
												{
													$requesterName = trim($_POST['username']);
													$hospitalName = $_POST["hospitalname"];
													$requestedBloodGroup = $_POST["bloodgroup"];
													if($user_home->requestblood($requesterName,$hospitalName,$requestedBloodGroup))
													{
														echo '<script type="text/javascript">alert("Request Placed")</script>';
													}
												}
												else
												{
													echo '<script type="text/javascript">alert("Please Login")</script>';
												}
										
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
</body>
</html>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js'></script><script  src="./script.js"></script>

</body>
</html>
