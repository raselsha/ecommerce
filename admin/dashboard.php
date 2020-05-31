
<?php 
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location:index.php');
	}

	require '../classes/connection.php';
	$con = new connection();
	require '../classes/category.php';
	$cat = new category();
	require '../classes/type.php';
	$typ = new type();
	require '../classes/medicine.php';
	$med = new medicine();


	if (isset($_GET['action']) and $_GET['action']=='logout') {
		unset($_SESSION['name']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		header('Location:index.php');
	}
 	 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../assets/admin/css/style.css">
</head>
<body>
	<table width="100%" cellpadding="5">
		<tr bgcolor="#eee" style="border-bottom: 2px solid #D82012;">
			<td>
				<a href="./"><img src="../assets/admin/image/Hamdard.png" alt="Hamdard" width="150" align="left"></a>
				<a href="../index.php" style="margin-top:15px;display: block;" target="_blank">Shop</a>
			</td>
			<td colspan="" align="right">
				Today is: <strong><?= date('d F, Y'); ?></strong> | 
				Loged in: <strong><?= $_SESSION['name'] ?></strong> | Email: <strong><?= $_SESSION['email'] ?></strong> | 
				<a href="changed_password.php">Change password</a> | 
				<a href="?action=logout">Logout</a>
			</td>
		</tr>
		<tr>
			<td width="14%" height="" bgcolor="#eee" valign="top">
				<nav>
					<ul>
						<li><a href="category.php"><span class="red">&#9784</span> Category</a></li>
						<li><a href="type.php"><span class="red">&#9784</span> Type</a></li>
						<li><a href="medicine.php"><span class="red">&#9784</span> Medicine</a></li>
					</ul>
				</nav>
			</td>
			<td width="80%" height="520" valign="top" bgcolor="#fff" >
				<?php
					if (isset($page)) {
						include 'pages/'.$page.'.php';
					}
					else{
						include 'pages/home.php';
					}
				?>
			</td>
		</tr>
	</table>
</body>
</html>