<?php include 'include/header.php'; ?>

	<div class="row py-4">
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