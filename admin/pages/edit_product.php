<?php
	
	$name = '';
	$unit = '';
	$price = '';
	$type_id = '';
	$category_id ='';

	$er_name = '';
	$er_unit = '';
	$er_price = '';
	$er_type_id = '';
	$er_category_id ='';

	$er = 0;
	$message = '';

	
	if (isset($_POST['update'])) {
		$name = $_POST['name'];
		$unit = $_POST['unit'];
		$price = $_POST['price'];
		$type_id = $_POST['type_id'];
		$category_id = $_POST['category_id'];

		if (empty($name)) {
			$er_name = '<small class="red">This field is required!</small>';
			$er++;
		}
		 

		if (empty($unit)) {
			$er_unit = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($price)) {
			$er_price = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($type_id)) {
			$er_type_id = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($category_id)) {
			$er_category_id = '<small class="red">This field is required!</small>';
			$er++;
		}
		 
		if (!empty($_FILES['image']['name'])) {
			$image = $_FILES['image'];
			$_POST['image_name'] = $image['name']; 
			$_POST['image_path'] = $image['tmp_name'];
		}
		else{
			$_POST['image_name'] = '';
			$_POST['image_path'] = '';
		}

		if ($er==0) {

			$message = $prdct->update_product($_POST);

		}
	}

	$id = base64_decode($_GET['id']);
	$product = $prdct->single_product($id);
	$prodct = mysqli_fetch_assoc($product);
	

?>

<h2>Edit Medicine <?= $message; ?></h2>
<form method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-4">
		<p><label>Product name </label></p>
		<p><input type="text" name="name" value="<?= $prodct['name']; ?>"><?= $er_name; ?></p>
		<p><label>Unit </label></p>
		<p><input type="text" name="unit" value="<?= $prodct['unit']; ?>"><?= $er_unit; ?></p>
		<p><label>Price </label></p>
		<p><input type="text" name="price" value="<?= $prodct['price']; ?>"><?= $er_price; ?></p>
	</div>
	<div class="col-4">
		<p><label>Type (English)</label></p>
		<p>
			<select name="type_id">
				<option value="">select</option>
				<?php
					$types = $typ->all_type();
					while ($type = mysqli_fetch_assoc($types)):?>
					<?php if($prodct['type_id']==$type['id']): ?>
						<option value="<?= $type['id']; ?>" selected><?= $type['type_name']; ?></option>
					<?php else:?>	
						<option value="<?= $type['id']; ?>"><?= $type['type_name']; ?></option>
					<?php endif;?>	
				<?php endwhile;?>
			</select>
			<?= $er_type_id; ?>
			
		</p>
		<p><label>Category (English)</label></p>
		<p>
			<select name="category_id">
				<option value="">select</option>
				<?php
					$category = $cat->all_category();
					while ($cat = mysqli_fetch_assoc($category)):?>
					<?php if($prodct['category_id']==$cat['id']): ?>
						<option value="<?= $cat['id']; ?>" selected><?= $cat['category']; ?></option>
					<?php else:?>	
						<option value="<?= $cat['id']; ?>"><?= $cat['category']; ?></option>
					<?php endif;?>	
				<?php endwhile;?>
			</select>
			<?= $er_category_id; ?>
		</p>
		<p>
			<label>Medicine Image </label>
		</p>
		<p>
			<input type="file" name="image">
		</p>
		<p><input type="submit" name="update" value="save"></p>
	</div>
</div>
</form>
<p>
	<a href="products.php" class="green_bg white padding">Back</a>
</p>