<?php 

	if (isset($_GET['action']) and $_GET['action']=='delete') {
		$id = base64_decode($_GET['id']);
		$med->delete_medicine($id);
	}

	if (isset($_GET['action']) and $_GET['action']=='duplicate') {
		$id = base64_decode($_GET['id']);
		$med->duplicate_medicine($id);
	}

?>

<h2>Medicine</h2>
<p align="right">
	<form method="get" action="search.php">
		Search by name:
		<input type="text" name="search">
		<input type="submit" name="" value="Search">
	</form>
</p>
<table width="100%">
	<tr>
		<td colspan="11"><a href="add_medicine.php" class="blue_bg padding white">Add medicine</a></td>
	</tr>
	<tr bgcolor="#eee">
		<th>Sl</th>
		<th>Name (English)</th>
		<th>Name (বাংলা)</th>
		<th>Group name</th>
		<th>Unit</th>
		<th>Price</th>
		<th>Type</th>
		<th>Category</th>
		<th>Action</th>
	</tr>
	<?php
		$limit = 12;
		$offset = 0;
		$next = 1;
		$prev = 1;
		$page = 1;
		if (isset($_GET['page']) and $_GET['page'] != '') {
			$page = $con->secure($_GET['page']);

			$prev=$page;
			$next=$page;

			$offset = ($page*$limit)-$limit;
			$result = $med->all_medicine($limit,$offset);
		}
		else{
			$result = $med->all_medicine($limit,$offset);
		}
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<tr>';
				echo '<td width="2%">'.++$offset.'</td>';
				echo '<td><a href="medicine_details.php?id='.base64_encode($row['id']).'">'.$row['name_en'].'</a></td>';
				echo '<td>'.$row['name'].'</td>';
				echo '<td>'.$row['name_grp'].'</td>';
				echo '<td>'.$row['unit'].'</td>';
				echo '<td>'.$row['price'].'</td>';
				echo '<td>'.$row['type_name'].'</td>';				
				echo '<td>'.$row['category'].'</td>';
				echo '<td align="center" width="180">
						<a class="green_bg white padding" href="?action=duplicate&&id='.base64_encode($row['id']).'">Duplicate</a>  
						<a class="yellow_bg white padding" href="edit_medicine.php?id='.base64_encode($row['id']).'">Edit</a>  
						<a class="red_bg white padding" href="?action=delete&&id='.base64_encode($row['id']).'">Delete</a>
					 </td>';
			echo '</tr>';
		}
	?>
</table>
<p class="pagination">
	<?php

		$total_row =$med->medicine_row_count();
		$total_page = ceil($total_row/$limit);
		if ($total_page>1) {
			if ($prev>1) {
				echo '<a href="?page=1"> First </a>';
				echo '<a href="?page='.--$prev.'"> Prev </a>';
			}
			for ($i=1; $i <=$total_page ; $i++) { 
				if ($page==$i) {
					echo '<a href="?page='.$i.'" class="active"> '.$i.' </a>';
				}
				else{
					echo '<a href="?page='.$i.'" > '.$i.' </a>';
				}
			}
			if ($next<$total_page) {
				echo '<a href="?page='.++$next.'"> Next </a>';
				echo '<a href="?page='.$total_page.'"> Last </a>';
			}
		}
		
	?>
</p>