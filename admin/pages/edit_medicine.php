<?php
	
	$name = '';
	$name_en = '';
	$name_grp =''; 
	$used = '';
	$unit = '';
	$price = '';
	$price_en = '';
	$instruction =''; 
	$prescribe = '';
	$type_id = '';
	$category_id ='';

	$er_name = '';
	$er_name_en = '';
	$er_name_grp =''; 
	$er_used = '';
	$er_unit = '';
	$er_price = '';
	$er_price_en = '';
	$er_instruction =''; 
	$er_prescribe = '';
	$er_type_id = '';
	$er_category_id ='';

	$er = 0;
	$message = '';

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$name_en = $_POST['name_en'];
		$name_grp =$_POST['name_grp']; 
		$used = $_POST['used'];
		$unit = $_POST['unit'];
		$price = $_POST['price'];
		$price_en = $_POST['price_en'];
		$instruction = $_POST['instruction']; 
		$prescribe = $_POST['prescribe'];
		$type_id = $_POST['type_id'];
		$category_id = $_POST['category_id'];

		if (empty($name)) {
			$er_name = '<small class="red">This field is required!</small>';
			$er++;
		}
		 
		if (empty($name_en)) {
			$er_name_en = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($name_grp)) {
			$er_name_grp = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($used)) {
			$er_used = '<small class="red">This field is required!</small>';
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

		if (empty($price_en)) {
			$er_price_en = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($instruction)) {
			$er_instruction = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($prescribe)) {
			$er_prescribe = '<small class="red">This field is required!</small>';
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

			$message = $med->update_medicine($_POST);

		}
	}

	$id = base64_decode($_GET['id']);
	$medicine = $med->single_medicine($id);
	$medi = mysqli_fetch_assoc($medicine);

?>

<h2>Edit Medicine <?= $message; ?></h2>
<table width="100%">
	<form method="post" enctype="multipart/form-data">
		<tr valign="top">
			<td width="40%">
				
				<p><label>Medicine name (English)</label></p>
				<p><input type="text" name="name_en" value="<?= $medi['name_en']; ?>"><?= $er_name_en; ?></p>

				<p><label>Medicine name (বাংলা)</label></p>
				<p><input type="text" name="name" value="<?= $medi['name']; ?>"><?= $er_name; ?></p>

				<p><label>Medicine group name (বাংলা)</label></p>
				<p><input type="text" name="name_grp" value="<?= $medi['name_grp']; ?>"><?= $er_name_grp; ?></p>

				<p><label>Instruction (বাংলা)</label></p>
				<p><textarea name="instruction"><?= $medi['instruction']; ?></textarea><?= $er_instruction; ?></p>

				<p><label>Prescribe (বাংলা)</label></p>
				<p><textarea name="prescribe"><?= $medi['prescribe']; ?></textarea><?= $er_prescribe; ?></p>
			</td>
			<td>
				
				<p><label>Use (বাংলা)</label></p>
				<p><input type="text" name="used" value="<?= $medi['used']; ?>"><?= $er_used; ?></p>

				<p><label>Unit (বাংলা)</label></p>
				<p><input type="text" name="unit" value="<?= $medi['unit']; ?>"><?= $er_unit; ?></p>


				<p><label>Price (বাংলা)</label></p>
				<p><input type="text" name="price" value="<?= $medi['price']; ?>"><?= $er_price; ?></p>


				<p><label>Price (English)</label></p>
				<p><input type="text" name="price_en" value="<?= $medi['price_en']; ?>"><?= $er_price_en; ?></p>

				<p><label>Type (English)</label></p>
				<p>
					<select name="type_id">
						<option value="">select</option>
						<?php
							$types = $typ->all_type();
							while ($type = mysqli_fetch_assoc($types)):?>
							<?php if($medi['type_id']==$type['id']): ?>
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
							<?php if($medi['category_id']==$cat['id']): ?>
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
				<p><input type="submit" name="save" value="save"></p>
			</td>
		</tr>
	</form>
</table>
<p>
	<a href="medicine.php" class="green_bg white padding">Back</a>
</p>