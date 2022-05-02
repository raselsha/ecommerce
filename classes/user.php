<?php 

		
	class User extends connection{
		public function check_login($data)
		{	
			
			$con = $this->con();
			$data['password'] =  md5($data['password']);
			$sql = "SELECT * FROM user WHERE email = '$data[email]' and password = '$data[password]'";

			if (mysqli_query($con,$sql)) {
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);
				return $row;
			}
			else{
				return 0;
			}
		}

		
		public function save_user($data)
		{	
			
			$con = $this->con();
			$data['password'] =  md5($data['password']);
			$sql = "INSERT INTO user(name,email,password) VALUES('$data[name]','$data[email]','$data[password]')";
			
			if (mysqli_query($con,$sql)) {
				$sql = "SELECT * FROM user WHERE email = '$data[email]' and password = '$data[password]'";
				if (mysqli_query($con,$sql)) {
					$result = mysqli_query($con,$sql);
					$row = mysqli_fetch_assoc($result);
					return $row;
				}
				else{
					return 0;
				}
			}
			else{
				return 0;
			}
		}
	}

 ?>