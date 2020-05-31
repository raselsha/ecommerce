<?php

	$category = '';
	$category_bn = '';
	$category_en = '';

	$er_category = '';
	$er_category_bn = '';
	$er_category_en = '';

	$er=0;
	$message='';

	if (isset($_POST['update'])) {
		$category = $_POST['category'];
		$category_bn = $_POST['category_bn'];
		$category_en = $_POST['category_en'];

		if (empty($category)) {
			$er_category = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($category_bn)) {
			$er_category_bn = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($category_en)) {
			$er_category_en = '<small class="red">This field is required!</small>';
			$er++;
		}

		if ($er==0) {
			$message=$cat->update_category($_POST);
		}
		
	}
	$id = base64_decode($_GET['id']);
	$result = $cat->single_category($id);
	$row = mysqli_fetch_assoc($result);

?>

<h2>Add Category <?php if($message){ echo $message; }?></h2>
<table width="100%">
	<tr>
		<td>
			<form method="post">
				<fieldset>
					<legend>Add category</legend>
					<p><label>Category</label></p>
					<p><input type="text" name="category" value="<?= $row['category']; ?>"><?= $er_category; ?></p>
					<p><label>Category বাংলা</label></p>
					<p><input type="text" name="category_bn" value="<?= $row['category_bn']; ?>"><?= $er_category_bn; ?></p>
					<p><label>Category English</label></p>
					<p><input type="text" name="category_en" value="<?= $row['category_en']; ?>"><?= $er_category_en; ?></p>
					<p><input type="submit" name="update" value="save"></p>
				</fieldset>
			</form>
			<p><a href="category.php">Back</a></p>
		</td>
	</tr>
</table>