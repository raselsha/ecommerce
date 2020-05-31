<?php 

if (isset($_GET['action']) and $_GET['action']=='delete') {
	$id = base64_decode($_GET['id']);
	$cat->delete_category($id);
}

?>
<h2>Category</h2>

<table width="100%" >
	<tr>
		<td colspan="5"><a href="add_category.php">Add category</a></td>
	</tr>
	<tr bgcolor="#eee">
		<th>Sl</th>
		<th width="200">Category</th>
		<th width="300">Category (<small> বাংলা </small>)</th>
		<th width="300">Category (<small> English </small>)</th>
		<th width="100">Action</th>
	</tr>
	<?php
				
		$result = $cat->all_category();
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<tr >';
				echo '<td width="2%">'.$row['id'].'</td>';
				echo '<td>'.$row['category'].'</td>';
				echo '<td>'.$row['category_bn'].'</td>';
				echo '<td>'.$row['category_en'].'</td>';
				echo '<td>
						<a class="blue" href="edit_category.php?id='.base64_encode($row['id']).'">Edit</a>
						<a class="red" href="?action=delete&&id='.base64_encode($row['id']).'">Delete</a>
					 </td>';
			echo '</tr>';
		}
	?>
</table>