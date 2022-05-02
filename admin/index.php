<?php
	session_start();
	if (isset($_SESSION['admin_email'])) {
		echo '<script>window.location.href = "dashboard.php";</script>';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/admin/css/style.css">
</head>
<body>
	<?php 
		require '../classes/connection.php';
		$con = new connection();

		require '../classes/user.php';
		$user = new user();

		$er_email='';
		$er_password='';
		$er=0;
		if (isset($_POST['login'])) {
			if (empty($_POST['email'])) {
				$er_email = '<p class="red">Email field required!</p>';
				$er++;
			}
			if (empty($_POST['password'])) {
				$er_password = '<p class="red">Password field required!</p>';
				$er++;
			}
			if ($er==0) {
				$row =$user->check_login($_POST);
				if($row){
					$_SESSION['admin_name']=$row['name'];
					$_SESSION['admin_email']=$row['email'];
					echo '<script>window.location.href = "dashboard.php";</script>';
					
				}
				else{
					$message =  '<p class="text-danger text-center">User data not matched</p>';
				}
				
			}
		}
	 ?>

	<div class="container">
		 <div class="row ">
		 	<div class="col-12 text-center mt-5">
		 		<img src="../assets/public/images/logo.png" width="120">
		 	</div>
		 	<div class="col-md-4 offset-md-4 bg-secondary border border-primary py-3 mt-3">
		 		<?= $message; ?>
	 			<form action="" method="post">
	 				<div class="form-group my-3">
	 				    <label >Email</label>
	 				    <input type="email"  name="email" class="form-control" placeholder="Enter email">
	 				    <small class="form-text"><?= $er_email; ?></small>
	 				</div>
						<div class="form-group my-3">
						    <label >Password</label>
						    <input type="password" name="password" class="form-control" placeholder="Password">
						    <small class="form-text"><?= $er_password; ?></small>
						</div>
						<div class="form-group my-4">
							<input type="submit" class="btn btn-primary" name="login" value="Login">

						</div>
	 				
	 			</form>
		 	</div>
		 </div>
	</div>
</body>
</html>