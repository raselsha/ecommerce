<?php 

	require 'connection.php';
	
	class Login extends connection
	{
		public function check_login($data)
		{	
			$obj = new connection();
			$con = $obj->con();
			
			$sql = "SELECT * FROM user WHERE email = '$data[email]' and password = md5('$data[password]')";
			if (mysqli_query($con,$sql)) {
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);
				session_start();
				$_SESSION['name']=$row['name'];
				$_SESSION['email']=$row['email'];
				$_SESSION['password']=$row['password'];
				header('Location:dashboard.php');
			}
			else{
				mysqli_error($con);
			}
		}
	}

 ?>