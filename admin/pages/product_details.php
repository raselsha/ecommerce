<?php
	
	$id = base64_decode($_GET['id']);
	$product = $prdct->single_product($id);
	$prodct = mysqli_fetch_assoc($product);

?>
<h2>Product details</h2>
<div class="row">
	<div class="col-4">
		<?php if($prodct['image']): ?>
			<img src="../assets/admin/upload/<?= $prodct['id']."_".$prodct['image'] ?>" class="img-fluid">
		<?php else: ?>
			<img src="../assets/admin/image/default.jpg" class="img-fluid">
		<?php endif; ?>
	</div>
	<div class="col-8">
		<h2 class="red"><?= $prodct['name']; ?></h2>
		<?php
   			echo '<a class="yellow_bg white padding" href="edit_product.php?id='.base64_encode($prodct['id']).'">Edit</a>
				<a class="red_bg white padding" href="products.php?action=delete&&id='.base64_encode($prodct['id']).'">Delete</a>';
			?>
		<table class="table">
			<tr>
			   <th width="7%" align="left">Category</th>
			   <td><?= $prodct['category']; ?>
			   </td>
			 </tr>
			 <tr>
		    	<th width="7%" align="left">Unit</th>
		    	<td><?= $prodct['unit']; ?></td>
		  	</tr>
			 <tr>
		    	<th width="7%" align="left">Type</th>
		    	<td><?= $prodct['type_name']; ?></td>
		  	</tr>
		  	<tr>
			   <th align="left">Price</th>
			   <td><?= $prodct['price']; ?></td>
			 </tr>
		</table>
	</div>
</div>
<p><a href="products.php" class="green_bg white padding">Back</a></p>

	