<div class="row">
	<div class="col-md-4">
		<h2 class="text-primary">About our shop</h2>
		<p class="dark-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
	<div class="col-md-4">
		<h2 class="text-primary">Important Links</h2>
		<ul class="nav flex-column">
	    	<?php
				$categories = $cat->all_category();
				while ($category = mysqli_fetch_assoc($categories)) :?>
				<li class="nav-item">
		        	<a class="nav-link text-primary"  href="category.php?id=<?= base64_encode($category['id']) ?>" ><?= $category['category']; ?></a>
		    	</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<div class="col-md-4">
		<img src="assets/public/images/gateway.jpg" class="img-fluid">
	</div>
</div>