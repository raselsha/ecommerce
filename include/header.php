<?php
	session_start();
	if (isset($_GET['action']) and $_GET['action']=='logout') {
		unset($_SESSION['name']);
		unset($_SESSION['email']);
	}	
	require 'classes/connection.php';
	$con = new connection();
	require 'classes/category.php';
	$cat = new category();
	require 'classes/products.php';
	$prdct = new products();
	require 'classes/user.php';
	$user = new user();
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ecommerce </title>
	<meta charset="utf-8">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/public/css/style.css">
</head>
<body>
	<div class="overlay"></div>
	<?php
		if (isset($_POST['add_to_cart'])) {
			$quantity=$_POST['quantity'];
			$record=$prdct->single_product($_POST['product_id']);
			$record=mysqli_fetch_assoc($record);
			
			if (!isset($_SESSION['shoppig_cart'])){
				$item_array = array(
					'item_id'=> $record['id'],
					'item_name'=> $record['name'],
					'item_price'=> $record['price'],
					'item_quantity'=> $quantity,
				);
				$_SESSION['shoppig_cart'][0]= $item_array;
			}
			else{
				$item_array_id = array_column($_SESSION['shoppig_cart'],'item_id');
				if (in_array($_POST['product_id'], $item_array_id)) {
					$index=array_search($_POST['product_id'], $item_array_id);
					$item_array = array(
						'item_id'=> $record['id'],
						'item_name'=> $record['name'],
						'item_price'=> $record['price'],
						'item_quantity'=> $quantity,
					);
					$_SESSION['shoppig_cart'][$index] = $item_array;
				}
				else{
					$count = count($_SESSION['shoppig_cart']);
					$item_array = array(
						'item_id'=> $record['id'],
						'item_name'=> $record['name'],
						'item_price'=> $record['price'],
						'item_quantity'=> $quantity,
					);
					$_SESSION['shoppig_cart'][$count] = $item_array;
				}
			}

		}

		if (isset($_GET['action']) and $_GET['action']=='qnty_plus') {
			$record=$prdct->single_product($_GET['id']);
			$record=mysqli_fetch_assoc($record);
			$item_array_id = array_column($_SESSION['shoppig_cart'],'item_id');

			if (in_array($_GET['id'], $item_array_id)) {
				$index=array_search($_GET['id'], $item_array_id);
				$item_array = array(
					'item_id'=> $record['id'],
					'item_name'=> $record['name'],
					'item_price'=> $record['price'],
					'item_quantity'=>  $_SESSION['shoppig_cart'][$index]['item_quantity']+1,
					
				);
				$_SESSION['shoppig_cart'][$index] = $item_array;
			}
		}

		if (isset($_GET['action']) and $_GET['action']=='qnty_minus') {
			$record=$prdct->single_product($_GET['id']);
			$record=mysqli_fetch_assoc($record);
			$item_array_id = array_column($_SESSION['shoppig_cart'],'item_id');

			if (in_array($_GET['id'], $item_array_id)) {
				$index=array_search($_GET['id'], $item_array_id);
				if ($_SESSION['shoppig_cart'][$index]['item_quantity']>1) {
					$item_array = array(
						'item_id'=> $record['id'],
						'item_name'=> $record['name'],
						'item_price'=> $record['price'],
						'item_quantity'=>  $_SESSION['shoppig_cart'][$index]['item_quantity']-1,
					);
					$_SESSION['shoppig_cart'][$index] = $item_array;
				}
				
			}
		}

		if (isset($_GET['action']) and $_GET['action']=='delete') {
			foreach ($_SESSION['shoppig_cart'] as $key => $value){
				if ($value['item_id'] == $_GET['id']) {
					unset($_SESSION['shoppig_cart'][$key]);	
				}
			}
		}
		if (isset($_GET['action']) and $_GET['action']=='empty') {
			unset($_SESSION['shoppig_cart']);
			header('Location:cart.php');
		}

	?>

	<div class="container">
		<div class="row header">
			<div class="col-md-2">
				<a href="./" class="d-block"><img src="assets/public/images/logo.png" alt="" class="w-75 p-2"></a>
			</div>
			<div class="col-md-10">
				<h6 class="text-end">
					<?php if(isset($_SESSION['email'])): ?>
						<p class="text-end text-white">Hello <?= $_SESSION['name']; ?>! <a href="?action=logout" class="bg-secondary border border-primary text-primary p-2 rounded">Logout</a></p>
					<?php else: ?>
						<p class="text-end text-primary"><a href="login.php" class="text-primary badge bg-white">Login</a>  <a href="register.php" class="text-primary badge bg-white">Register</a></p>
					<?php endif; ?>
					
				</h5>
				<div class="text-end mt-4">
					<a href="cart.php" class="buscket">View cart: <?php 
						if (isset($_SESSION['shoppig_cart'])){
							echo count($_SESSION['shoppig_cart']);
						} ?> 
						<i class="fa fa-shopping-basket"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="row bg-primary">
			<div class="col-md-12">
				<?php include 'include/menu.php'; ?>
			</div>
		</div>
	