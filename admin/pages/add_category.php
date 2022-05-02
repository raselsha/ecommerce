<?php

	$category = '';
	$category_desc = '';

	$er_category = '';
	$er_category_desc = '';

	$er=0;
	$message='';

	if (isset($_POST['save'])) {
		$category = $_POST['category'];
		$category_desc = $_POST['category_desc'];

		if (empty($category)) {
			$er_category = '<small class="red">This field is required!</small>';
			$er++;
		}

		if (empty($category_desc)) {
			$er_category_desc = '<small class="red">This field is required!</small>';
			$er++;
		}

		if ($er==0) {
			$message=$cat->add_category($_POST);
			$category = '';
			$category_desc = '';
		}
		
	}

?>

<h2>Add Category <?php if($message){ echo $message; }?></h2>
<table width="100%">
	<tr>
		<td>
			<form method="post">
				<fieldset>
					<legend>Add category</legend>
					<p><label>Category name</label></p>
					<p><input type="text" name="category" value="<?= $category; ?>"><?= $er_category; ?></p>
					<p><label>Category info</label></p>
					<p><input type="text" name="category_desc" value="<?= $category_desc; ?>"><?= $er_category_desc; ?></p>
					<p><input type="submit" name="save" value="save"></p>
				</fieldset>
			</form>
			<p><a href="category.php">Cancel</a></p>
		</td>
	</tr>
</table>