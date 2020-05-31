<?php
	session_start();
	require_once "config.php";
	
	if (isset($_SESSION['email'])) {
		header('Location:dashboard.php');
	}

	$redirectURL = "http://localhost/hamdard/admin/fb-callback.php?close";
	$permissions = ['email'];
	$loginURL = $helper->getLoginUrl($redirectURL, $permissions);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../assets/admin/css/style.css">
</head>
<body>
	<?php 
		require '../classes/login.php';
		$obj = new login();

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
				$obj->check_login($_POST);
			}
		}
	 ?>
	 <p align="center">
	 	<img src="../assets/public/image/Hamdard.png" >
	 </p>
	 <table width="30%" align="center" cellpadding="20">
	 	<tr>
	 		<td bgcolor="#eee">
	 			<form method="post">
	 				<fieldset>
	 					<legend>Login</legend>
	 					<p><label>Email</label></p>
	 					<p><input type="text" name="email"></p>
	 					<?= $er_email; ?>
	 					<p><label>Password</label></p>
	 					<p><input type="password" name="password"></p>
	 					<?= $er_password; ?>
	 					<p>
	 						<input type="submit" name="login" value="Login">
	 						<input type="button" onclick="window.location='<?= $loginURL; ?>'" value="Login with facebook" style="padding:5px;border:1px solid #333;cursor: pointer;" class="blue_bg white">
	 					</p>
	 				</fieldset>
	 			</form>
	 			<p><a href="../">Back to main site</a></p>
	 		</td>
	 	</tr>
	 </table>
</body>
</html>