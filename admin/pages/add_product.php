<?php
	
	$name = '';
	$price = '';
	$unit = '';
	$type_id = '';
	$category_id ='';

	$er_name = '';
	$er_price = '';
	$er_unit = '';
	$er_type_id = '';
	$er_category_id ='';

	$er = 0;
	$message = '';

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$unit = $_POST['unit'];
		$price = $_POST['price'];
		$type_id = $_POST['type_id'];
		$category_id = $_POST['category_id'];

		if (empty($name)) {
			$er_name = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($price)) {
			$er_price = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($unit)) {
			$er_unit = '<small class="red">This field is required!</small>';
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

			$message = $prdct->add_product($_POST);
			$name = ''; 
			$price = '';
			$unit = '';
			$type_id = '';
			$category_id ='';
		}
	}

?>

<h2>Add Product <?= $message; ?></h2>
<form method="post" enctype="multipart/form-data">
<div class="row">
	
	<div class="col-4">
		<p><label>Product name </label></p>
			<p><input type="text" name="name" value="<?= $name; ?>"><?= $er_name; ?></p>
			
			<p><label>Unit</label></p>
			<p><input type="text" name="unit" value="<?= $unit; ?>"><?= $er_unit; ?></p>

			<p><label>Price </label></p>
			<p><input type="text" name="price" value="<?= $price; ?>"><?= $er_price; ?></p>

	</div>
	<div class="col-4">
		<p><label>Type (English)</label></p>
		<p>
			<select name="type_id">
				<option value="">select</option>
				<?php
					$types = $typ->all_type();
					while ($type = mysqli_fetch_assoc($types)):?>
					<?php if($type['id']==$type_id): ?>
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
					$categories = $cat->all_category();
					while ($category = mysqli_fetch_assoc($categories)):?>
					<?php if($category['id']==$category_id): ?>
						<option value="<?= $category['id']; ?>" selected><?= $category['category']; ?></option>
					<?php else:?>	
						<option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
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
		<p><input type="submit" name="save" value="save"></p>
	</div>
	
</div>
	</form>
