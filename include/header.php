<?php
	session_start();

	require 'classes/connection.php';
	$con = new connection();
	require 'classes/category.php';
	$cat = new category();
	require 'classes/medicine.php';
	$med = new medicine();	
	require 'classes/payment.php';
	$pay = new payment();		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hamdard </title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/public/css/style.css">
</head>
<body>
	<div class="overlay"></div>
	<?php
		if (isset($_POST['add_to_cart'])) {
			$quantity=$_POST['quantity'];
			$record=$med->single_medicine($_POST['product_id']);
			$record=mysqli_fetch_assoc($record);
			
			if (!isset($_SESSION['shoppig_cart'])){
				$item_array = array(
					'item_id'=> $record['id'],
					'item_name'=> $record['name'],
					'item_name_en'=> $record['name_en'],
					'item_name_grp'=> $record['name_grp'],
					'item_price_en'=> $record['price_en'],
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
						'item_name_en'=> $record['name_en'],
						'item_name_grp'=> $record['name_grp'],
						'item_price_en'=> $record['price_en'],
						'item_quantity'=> $_SESSION['shoppig_cart'][$index]['item_quantity']+$quantity,
					);
					$_SESSION['shoppig_cart'][$index] = $item_array;
				}
				else{
					$count = count($_SESSION['shoppig_cart']);
					$item_array = array(
						'item_id'=> $record['id'],
						'item_name'=> $record['name'],
						'item_name_en'=> $record['name_en'],
						'item_name_grp'=> $record['name_grp'],
						'item_price_en'=> $record['price_en'],
						'item_quantity'=> $quantity,
					);
					$_SESSION['shoppig_cart'][$count] = $item_array;
				}
			}

		}

		if (isset($_GET['action']) and $_GET['action']=='qnty_plus') {
			$record=$med->single_medicine($_GET['id']);
			$record=mysqli_fetch_assoc($record);
			$item_array_id = array_column($_SESSION['shoppig_cart'],'item_id');

			if (in_array($_GET['id'], $item_array_id)) {
				$index=array_search($_GET['id'], $item_array_id);
				$item_array = array(
					'item_id'=> $record['id'],
					'item_name'=> $record['name'],
					'item_name_en'=> $record['name_en'],
					'item_name_grp'=> $record['name_grp'],
					'item_price_en'=> $record['price_en'],
					'item_quantity'=> $_SESSION['shoppig_cart'][$index]['item_quantity']+1,
				);
				$_SESSION['shoppig_cart'][$index] = $item_array;
			}
		}

		if (isset($_GET['action']) and $_GET['action']=='qnty_minus') {
			$record=$med->single_medicine($_GET['id']);
			$record=mysqli_fetch_assoc($record);
			$item_array_id = array_column($_SESSION['shoppig_cart'],'item_id');

			if (in_array($_GET['id'], $item_array_id)) {
				$index=array_search($_GET['id'], $item_array_id);
				if ($_SESSION['shoppig_cart'][$index]['item_quantity']>1) {
					$item_array = array(
						'item_id'=> $record['id'],
						'item_name'=> $record['name'],
						'item_name_en'=> $record['name_en'],
						'item_name_grp'=> $record['name_grp'],
						'item_price_en'=> $record['price_en'],
						'item_quantity'=> $_SESSION['shoppig_cart'][$index]['item_quantity']-1,
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
		<div class="row">
			<div class="col-md-12">
				<div class="header-top text-right">
					<a href="cart.php">View cart: <?php 
						if (isset($_SESSION['shoppig_cart'])){
							echo count($_SESSION['shoppig_cart']);
						} ?> 
						<i class="fa fa-shopping-basket"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<a href="./" class="mt-3 d-block"><img src="assets/public/images/Hamdard.png" alt="Hamdard"></a>
			</div>
			<div class="col-md-8">
				<a href="./" class="text-right"><img src="assets/public/images/baner.png" alt="baner" align="right"></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php include 'include/menu.php'; ?>
			</div>
		</div>
	