<?php

	$limit = 15;
	$offset = 0;
	$next = 1;
	$prev = 1;
	$page = 1;
	if (isset($_GET['page']) and $_GET['page'] != '') {
		$page = $con->secure($_GET['page']);
		$prev=$page;
		$next=$page;

		$offset = ($page*$limit)-$limit;
		$product = $prdct->all_products($limit,$offset);
	}
	else{
		$product = $prdct->all_products($limit,$offset);
	}
?>
	<div class="row my-3">
		<div class="col-md-12">
			<h2 class="text-center">All Fruites</h2>
		</div>
	</div>
	<div class="row g-2">
		<?php while ($item = mysqli_fetch_assoc($product)) :?>		
			<div class="col-md-3 my-2">
				<div class="card bg-secondary border border-primary rounded">
					<a href="product_details.php?id=<?= base64_encode($item['id']); ?>">
					  <?php if($item['image']): ?>
					  	<img class="card-img-top" src="assets/admin/upload/<?= $item['id']."_".$item['image'] ?>" width="140">
					  <?php else: ?>
					  	<img class="card-img-top" src="assets/admin/image/default.jpg" width="140">
					  <?php endif; ?>
					</a>
				  <div class="card-body text-center">
				    <a href="product_details.php?id=<?= base64_encode($item['id']); ?>"><h6 class="card-title"><?= $item['name']; ?></h6></a>
				    <h2  class="price">$<?= $item['price']; ?></h2>
				    <form method="post">
				    	<input type="hidden" name="quantity" value="1" >
				    	<input type="hidden" name="product_id" value="<?= $item['id']; ?>">
				    	<input type="submit" name="add_to_cart" class="btn btn-primary " value="Add to cart">
				    </form>
				  </div>
				</div>

			</div>
		<?php endwhile; ?>
	</div>
<div class="row">
	<div class="col-md-12">
		<ul class="pagination">
			<?php
				$total_row = $prdct->products_row_count();
				$total_page = ceil($total_row/$limit);
				if ($total_page>1) {
					if ($prev>1) {
						echo '<li><a href="?page=1"> First </a></li>';
						echo '<li><a href="?page='.--$prev.'"> Prev </a></li>';
					}
					for ($i=1; $i <=$total_page ; $i++) { 
						if ($page==$i) {
							echo '<li><a href="?page='.$i.'" class="active"> '.$i.' </a></li>';
						}
						else{
							echo '<li><a href="?page='.$i.'" > '.$i.' </a></li>';
						}
					}
					if ($next<$total_page) {
						echo '<li><a href="?page='.++$next.'"> Next </a></li>';
						echo '<li><a href="?page='.$total_page.'"> Last </a></li>';
					}
				}
			?>
		</ul>
	</div>
</div>