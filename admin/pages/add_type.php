<?php

	$type_name = '';
	$er_type_name = '';
	$er=0;
	$message='';
	if (isset($_POST['save'])) {
		$type_name = $_POST['type_name'];
		if (empty($type_name)) {
			$er_type_name = '<small class="red">This field is required!</small>';
			$er++;
		}
		if ($er==0) {
			$message=$typ->add_type($_POST);
			$type_name = '';
		}
	}
?>
<h2>Add type <?php if($message){ echo $message; }?></h2>
<table width="100%">
	<tr>
		<td>
			<form method="post">
				<fieldset>
					<legend>Add type</legend>
					<p><label>Type name</label></p>
					<p><input type="text" name="type_name" value="<?= $type_name; ?>"><?= $er_type_name; ?></p>
					<p><input type="submit" name="save" value="save"></p>
				</fieldset>
			</form>
			<p><a href="type.php">Cancel</a></p>
		</td>
	</tr>
</table>