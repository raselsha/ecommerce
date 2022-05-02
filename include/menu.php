<nav class="navbar navbar-expand-lg navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="./">Home</a>
      </li>
    	<?php
			$categories = $cat->all_category();
			while ($category = mysqli_fetch_assoc($categories)) :?>
			<li class="nav-item">
	        	<a class="nav-link" href="category.php?id=<?= base64_encode($category['id']) ?>" ><?= $category['category']; ?></a>
	    	</li>
		<?php endwhile; ?>
    </ul>
  </div>
</nav>