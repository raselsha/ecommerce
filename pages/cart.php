	<?php  if (!empty($_SESSION['shoppig_cart'])): ?>
		<table border="1" width="100%">
			<tr>
				<th>Item name</th>
				<th>Quantity</th>
				<th>Unit Price</th>
				<th>Sub Total</th>
				<th>Action</th>
			</tr>
			<?php 
				$total = 0;
				foreach ($_SESSION['shoppig_cart'] as $key => $value):?>

					<tr>
						<td align="center">
							<h2 class="red"><?= $value['item_name_en']; ?></h2>
							<span><?= $value['item_name']; ?>
							(<?= $value['item_name_grp']; ?>)</span><br>
							<strong class="blue"><?= $value['item_price_en']; ?> TK.</strong>
						</td>
						<td align="center">
							<h2><a href="?action=qnty_minus&id=<?= $value['item_id']; ?>">-</a>
							<?= $value['item_quantity']; ?>
							<a href="?action=qnty_plus&id=<?= $value['item_id']; ?>">+</a></h2>
						</td>
						<td align="center">
							<h3><?= $value['item_quantity']; ?> x
							<?= $value['item_price_en']; ?></h3>
						</td>
						<td align="center">
							<h3><?= number_format($value['item_price_en']*$value['item_quantity'],2); ?></h3>
						</td>
						<td align="center"><a href="?action=delete&id=<?= $value['item_id']; ?>" class="red">Remove</a></td>
					</tr>
					<?php $total = $total + ($value['item_price_en']*$value['item_quantity']); ?>	
				<?php endforeach; ?>
				<tr>
					<td colspan="3" align="right"><strong>Total</strong></td>
					<td colspan="2" ><h1><?= number_format($total,2); ?> TK.</h1></td>
					
				</tr>
				<tr>
					<td colspan="5" align="right">
						<h3><a href="cart.php?action=empty" class="green_bg padding blue">Empty cart</a> <a href="index.php" class="green_bg padding blue">Continue Shopping</a> <a href="checkout.php" class="green_bg padding blue">Check out</a></h3>
					</td>
				</tr>
		</table>
	<?php else: ?>
		<table border="1" width="70%">
			<tr>
				<td><h2>Cart is empty</h2>
					<a href="index.php" class="padding">Continue Shopping</a>
				</td>
			</tr>
	<?php endif; ?>
