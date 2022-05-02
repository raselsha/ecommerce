<?php 

if (isset($_GET['action']) and $_GET['action']=='delete') {
	$id = base64_decode($_GET['id']);
	$typ->delete_type($id);
}

?>
<h2>Type</h2>

<table width="100%" >
	<tr>
		<td colspan="5"><a href="add_type.php">Add type</a></td>
	</tr>
	<tr bgcolor="#eee">
		<th width="20">Sl</th>
		<th width="200">Type name</th>
		<th width="100">Action</th>
	</tr>
	<?php
				
		$result = $typ->all_type();
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<tr >';
				echo '<td >'.$row['id'].'</td>';
				echo '<td >'.$row['type_name'].'</td>';
				echo '<td >
						<a class="blue" href="edit_type.php?id='.base64_encode($row['id']).'">Edit</a>
						<a class="red" href="?action=delete&&id='.base64_encode($row['id']).'">Delete</a>
					 </td>';
			echo '</tr>';
		}
	?>
</table>