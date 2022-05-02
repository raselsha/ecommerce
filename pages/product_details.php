<?php
	$pid = base64_decode($_GET['id']);
	$product = $prdct->single_product($pid);
	$pro = mysqli_fetch_assoc($product);
?>
<div class="row ">
	<div class="col-md-12  my-3">
		<h2 class="text-center"><?= $pro['name']; ?></h2>
	</div>
	<div class="col-md-4">
		<?php if($pro['image']): ?>

			<img src="assets/admin/upload/<?= $pro['id']."_".$pro['image'] ?>" class="img-fluid">

		<?php else: ?>

			<img src="assets/admin/image/default.jpg" class="img-fluid">

		<?php endif; ?>
	</div>
	<div class="col-md-8">
		<table class="table">
			<tr>

			   <th width="7%" align="left">Category</th>

			   <td colspan="2"><?= $pro['category']; ?>

			   </td>

			</tr>

			<tr>

			    <th  align="left">Unit</th>

			    <td colspan="2"><?= $pro['unit']; ?>

			    </td>

			  </tr>

			<tr>

			   <th  align="left">Type</th>

			   <td colspan="2"><?= $pro['type_name']; ?>

			   </td>

			</tr>

			<tr>

			   <th align="left">Price</th>

			   <td colspan="2"><?= $pro['price']; ?></td>

			</tr>

	</table>
	<?php include 'include/cart.php'; ?>
	</div>
</div>
