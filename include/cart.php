<form method="post">
	<input type="number" name="quantity" value="1" style="width:40px; padding:5px;" min="1" max="100">
	<input type="hidden" name="product_id" value="<?= $medi['id']; ?>">
	<input type="submit" name="add_to_cart" class="green_bg white" style="border:1px solid #777; padding:5px; font-size:14px;font-weight: bold;cursor: pointer;" value="Add to cart">
</form>