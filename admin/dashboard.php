<?php 
	session_start();
	if (!isset($_SESSION['admin_email'])) {
		echo '<script>window.location.href = "index.php";</script>';
	}
	require '../classes/connection.php';
	$con = new connection();
	require '../classes/category.php';
	$cat = new category();
	require '../classes/type.php';
	$typ = new type();
	require '../classes/products.php';
	$prdct = new products();


	if (isset($_GET['action']) and $_GET['action']=='logout') {
		unset($_SESSION['admin_name']);
		unset($_SESSION['admin_email']);
		echo '<script>window.location.href = "index.php";</script>';
	}
 	 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/admin/css/style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row bg-secondary border border-primary border-bottom-2">
			<div class="col-2">
				<a href="./"><img src="../assets/public/images/logo.png" width="120"></a>
			</div>
			<div class="col-10">
				<p class="text-end">
					<a href="../index.php" target="_blank">View Store front</a> | 
				Today is: <strong><?= date('d F, Y'); ?></strong> | 
				Loged in: <strong><?php echo $_SESSION['admin_name']; ?></strong> | Email: <strong><?= $_SESSION['admin_email'] ?></strong>
				</p>
				<p  class="text-end">
					<a class="btn btn-warning" href="changed_password.php">Change password</a>   
					<a class="btn btn-danger" href="?action=logout">Logout</a>
				</p>
			</div>
		</div>
		<div class="row  vh-100">
			<div class="col-2 bg-secondary border border-primary border-end-2">
				<nav class="nav flex-column">
					<a class="nav-link" href="category.php"><span class="red">&#9784</span> Category</a>
					<a class="nav-link" href="type.php"><span class="red">&#9784</span> Type</a>
					<a class="nav-link" href="products.php"><span class="red">&#9784</span> Products</a>
				</nav>
			</div>
			<div class="col-10">
					<?php
						if (isset($page)) {
							include 'pages/'.$page.'.php';
						}
						else{
							include 'pages/home.php';
						}
					?>
			</div>
		</div>
	</div>
</body>
</html>