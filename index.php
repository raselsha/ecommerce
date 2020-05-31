<?php include 'include/header.php'; ?>
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-center">
				<?php
					if (isset($_GET['id'])) {
						$id = base64_decode($_GET['id']);
						$categories = $cat->single_category($id);
						$category = mysqli_fetch_assoc($categories);
						echo $category['category_bn']." (".$category['category_en'].") ";
					}
				?>
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
				if (isset($page)) {
					include 'pages/'.$page.'.php';
				}
				else{
					include 'pages/home.php';
				}
			?>
		</div>
	</div>
	
<?php include 'include/footer.php'; ?>