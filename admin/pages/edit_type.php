<?php

	$type_name = '';
	$er_type_name = '';
	$er=0;
	$message='';

	if (isset($_POST['update'])) {
		$type_name = $_POST['type_name'];

		if (empty($type_name)) {
			$er_type_name = '<small class="red">This field is required!</small>';
			$er++;
		}

		if ($er==0) {
			$message=$typ->update_type($_POST);
		}
		
	}
	$id = base64_decode($_GET['id']);
	$result = $typ->single_type($id);
	$row = mysqli_fetch_assoc($result);

?>

<h2>Edit type <?php if($message){ echo $message; }?></h2>
<table width="100%">
	<tr>
		<td>
			<form method="post">
				<fieldset>
					<legend>Edit type</legend>
					<p><label>Type name</label></p>
					<p><input type="text" name="type_name" value="<?= $row['type_name']; ?>"><?= $er_type_name; ?></p>
					<p><input type="submit" name="update" value="save"></p>
				</fieldset>
			</form>
			<p><a href="type.php">Back</a></p>
		</td>
	</tr>
</table>