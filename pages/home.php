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
		$medicine = $med->all_medicine($limit,$offset);
	}
	else{
		$medicine = $med->all_medicine($limit,$offset);
	}
?>
	<div class="row">
		<?php while ($medi = mysqli_fetch_assoc($medicine)) :?>		
			<div class="col-md-3">
				<div class="bg-light border border-danger p-3 mb-2 mx-auto">
					<div class="product-image ">
						<?php if($medi['image']): ?>
							<img class="rounded mx-auto d-block" src="assets/admin/upload/<?= $medi['id']."_".$medi['image'] ?>" width="140">
						<?php else: ?>
							<img class="rounded mx-auto d-block" src="assets/admin/image/default.jpg" width="140">
						<?php endif; ?>
					</div>
					<div class="product-name">
				   		<h2 class="red"><?= $medi['name']; ?></h2>
				   		<h3  class="blue"><?= $medi['name_en']; ?></h3>
					   	<?php if ($medi['name_grp']):?>
					   		<p>( <?= $medi['name_grp'] ?> )</p>
					   	<?php endif; ?>
					</div>
					<div class="cart-button">
						<?php include 'include/cart.php'; ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
<div class="row">
	<div class="col-md-12">
		<ul class="pagination">
			<?php
				$total_row =$med->medicine_row_count();
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