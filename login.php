<?php include 'include/header.php'; ?>

	<div class="row py-4">
		<div class="col-md-12">
			<?php
				if (isset($_SESSION['email'])) {
					echo '<script>window.location.href = "index.php";</script>';
				}
							
				$er_email='';
				$er_password='';
				$message = '';
				$er=0;
				if (isset($_POST['login'])) {
					if (empty($_POST['email'])) {
						$er_email = '<p class="text-danger">Email field required!</p>';
						$er++;
					}
					if (empty($_POST['password'])) {
						$er_password = '<p class="text-danger">Password field required!</p>';
						$er++;
					}
					if ($er==0) {
						$row =$user->check_login($_POST);
						if($row){
							$_SESSION['name']=$row['name'];
							$_SESSION['email']=$row['email'];
							
							echo '<script>window.location.href = "index.php";</script>';
							
						}
						else{
							$message =  '<p class="text-danger text-center">User not saved</p>';
						}
						
					}
				}

			?>

				 <div class="row my-3">
				 	<div class="col-md-12">
				 		<h2 class="text-center">Login</h2>
				 	</div>
				 </div>
				 <div class="row g-2">
				 	<div class="col-md-4 offset-md-4 bg-secondary border border-primary">
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
									<input type="submit" class="btn btn-primary" name="login" value="Login"> <a class="btn btn-default" href="register.php">Register</a>

								</div>
			 				
			 			</form>
				 	</div>
				 </div>
			</body>
			</html>
		</div>
	</div>
	
<?php include 'include/footer.php'; ?>