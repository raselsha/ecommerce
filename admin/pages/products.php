<?php 

	if (isset($_GET['action']) and $_GET['action']=='delete') {
		$id = base64_decode($_GET['id']);
		$prdct->delete_product($id);
	}

	if (isset($_GET['action']) and $_GET['action']=='duplicate') {
		$id = base64_decode($_GET['id']);
		$prdct->duplicate_product($id);
	}

?>

<h2>Products</h2>
<p align="right">
	<form method="get" action="search.php">
		Search by name:
		<input type="text" name="search">
		<input type="submit" name="" value="Search">
	</form>
</p>
<table width="100%" class="table table-bordered">
	<tr>
		<td colspan="11"><a href="add_product.php" class="blue_bg padding white">Add Product</a></td>
	</tr>
	<tr bgcolor="#eee">
		<th>Sl</th>
		<th>Name</th>
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
			$result = $prdct->all_products($limit,$offset);
		}
		else{
			$result = $prdct->all_products($limit,$offset);
		}
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<tr>';
				echo '<td width="2%">'.++$offset.'</td>';
				echo '<td><a href="product_details.php?id='.base64_encode($row['id']).'">'.$row['name'].'</a></td>';
				echo '<td>'.$row['unit'].'</td>';
				echo '<td>'.$row['price'].'</td>';
				echo '<td>'.$row['type_name'].'</td>';				
				echo '<td>'.$row['category'].'</td>';
				echo '<td align="center" width="200">
						<a class="text-info p-2" href="?action=duplicate&&id='.base64_encode($row['id']).'">Duplicate</a>  
						<a class="text-warning p-2" href="edit_product.php?id='.base64_encode($row['id']).'">Edit</a>  
						<a class="text-danger p-2" href="?action=delete&&id='.base64_encode($row['id']).'">Delete</a>
					 </td>';
			echo '</tr>';
		}
	?>
</table>
<p class="pagination">
	<?php

		$total_row =$prdct->medicine_row_count();
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