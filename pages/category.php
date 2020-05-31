<?php

	$cid = base64_decode($_GET['id']);

	$limit = 5;

	$offset = 0;

	$next = 1;

	$prev = 1;

	$page = 1;

	if (isset($_GET['page']) and $_GET['page'] != '') {

		$page = $con->secure($_GET['page']);



		$prev=$page;

		$next=$page;



		$offset = ($page*$limit)-$limit;

		$medicine = $med->all_medicine_by_cat($cid,$limit,$offset);

	}

	else{

		$medicine = $med->all_medicine_by_cat($cid,$limit,$offset);

	}

	

	while ($medi = mysqli_fetch_assoc($medicine)) :?>

	<table class="table">

		<tr>

			<td rowspan="6" width="10%" >

				<?php if($medi['image']): ?>

					<img src="assets/admin/upload/<?= $medi['id']."_".$medi['image'] ?>" width="140">

				<?php else: ?>

					<img src="assets/admin/image/default.jpg" width="140">

				<?php endif; ?>

			</td>

		</tr>

		<tr>

		   <td colspan="2" width="20%" align="center">

		   		<h2 class="red"><?= $medi['name']; ?></h2>

		   		<h2  class="blue"><?= $medi['name_en']; ?></h2>

			   	<?php if ($medi['name_grp']):?>

			   		<p>( <?= $medi['name_grp'] ?> )</p>

			   	<?php endif; ?>

		   </td>

		   <td width="20%" align="center">

		   		<?php include 'include/cart.php'; ?>

		   </td>

		   <td width="40%" rowspan="5" valign="top">

		   		<p><strong class="sky">রোগ নির্দেশনাঃ </strong><?= $medi['instruction']; ?></p>

		   		<p><strong class="sky">সেবন বিধিঃ </strong><?= $medi['prescribe']; ?></p>

		   </td>

		</tr>

		<tr>

		   <th width="7%" align="left">Category</th>

		   <td colspan="2"><?= $medi['category']; ?>

		   </td>

		</tr>

		<tr>

		    <th  align="left">Type</th>

		    <td colspan="2"><?= $medi['type_name']; ?>

		    </td>

		  </tr>

		<tr>

		   <th  align="left">পরিবেশনা</th>

		   <td colspan="2"><?= $medi['used']." ".$medi['type_name']; ?>

		   </td>

		</tr>

		<tr>

		   <th align="left">খুচরা মূল্য</th>

		   <td colspan="2"><?= $medi['unit']." ".$medi['price']; ?></td>

		</tr>

	</table>

<?php endwhile; ?>
<div class="row">
	<div class="col-md-12">
		

		<ul class="pagination">

			<?php

				$total_row =$med->medicine_row_count_by_id($id);

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