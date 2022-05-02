<?php

	$cid = base64_decode($_GET['id']);

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

		$products = $prdct->all_products_by_cat($cid,$limit,$offset);

	}

	else{

		$products = $prdct->all_products_by_cat($cid,$limit,$offset);

	}
?>
<div class="row my-3">
	<div class="col-md-12">
		<h2 class="text-center">
			<?php
				if (isset($_GET['id'])) {
					$id = base64_decode($_GET['id']);
					$categories = $cat->single_category($id);
					$category = mysqli_fetch_assoc($categories);
					echo $category['category_desc'];
				}
			?>
		</h2>
	</div>
</div>
<div class="row g-2">
	<?php	while ($pro = mysqli_fetch_assoc($products)) :?>
		<div class="col-md-3 my-2">
			<div class="card bg-secondary border border-primary rounded">
			  <a href="product_details.php?id=<?= base64_encode($pro['id']); ?>">
			    <?php if($pro['image']): ?>
			    	<img class="card-img-top" src="assets/admin/upload/<?= $pro['id']."_".$pro['image'] ?>" width="140">
			    <?php else: ?>
			    	<img class="card-img-top" src="assets/admin/image/default.jpg" width="140">
			    <?php endif; ?>
			  </a>
			  <div class="card-body text-center">
			    <a href="product_details.php?id=<?= base64_encode($pro['id']); ?>"><h6 class="card-title"><?= $pro['name']; ?></h6></a>
			    <h2  class="price">$<?= $pro['price']; ?></h2>
			    <form method="post">
			    	<input type="hidden" name="quantity" value="1" >
			    	<input type="hidden" name="product_id" value="<?= $pro['id']; ?>">
			    	<input type="submit" name="add_to_cart" class="btn btn-primary " value="Add to cart">
			    </form>
			  </div>
			</div>
		</div>
	<?php endwhile; ?>
</div>
<!-- ===========pagination============ -->
<div class="row">
	<div class="col-md-12">
		

		<ul class="pagination">

			<?php

				$total_row =$prdct->products_row_count_by_id($id);

				$total_page = ceil($total_row/$limit);

				if ($total_page>1) {

					if ($prev>1) {

						echo '<li><a href="category.php?id='.$_GET['id'].'&&page=1"> First </a></li>';

						echo '<li><a href="category.php?id='.$_GET['id'].'&&page='.--$prev.'"> Prev </a></li>';

					}

					for ($i=1; $i <=$total_page ; $i++) { 

						if ($page==$i) {

							echo '<li><a href="category.php?id='.$_GET['id'].'&&page='.$i.'" class="active"> '.$i.' </a></li>';

						}

						else{

							echo '<li><a href="category.php?id='.$_GET['id'].'&&page='.$i.'" > '.$i.' </a></li>';

						}

					}

					if ($next<$total_page) {

						echo '<li><a href="category.php?id='.$_GET['id'].'&&page='.++$next.'"> Next </a></li>';

						echo '<li><a href="category.php?id='.$_GET['id'].'&&page='.$total_page.'"> Last </a></li>';

					}

				}

				

			?>

		</ul>

		
	</div>
</div>