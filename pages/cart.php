	<?php  if (!empty($_SESSION['shoppig_cart'])): ?>
		<table class="table table-bordered">
			<tr>
				<th class="text-start">Item name</th>
				<th class="text-center">Quantity</th>
				<th class="text-center">Unit Price</th>
				<th class="text-center">Sub Total</th>
				<th class="text-center">Action</th>
			</tr>
			<?php 
				$total = 0;
				foreach ($_SESSION['shoppig_cart'] as $key => $value):?>

					<tr>
						<td align="left">
							<h2 class="m-0"><?= $value['item_name']; ?></h2>
						</td>
						<td align="center">
							<h2><a href="?action=qnty_minus&id=<?= $value['item_id']; ?>">-</a>
							<?= $value['item_quantity']; ?>
							<a href="?action=qnty_plus&id=<?= $value['item_id']; ?>">+</a></h2>
						</td>
						<td align="center">
							<h3><?= $value['item_quantity']; ?> <small style="font-size:12px">&#x2715;</small>
							$<?= $value['item_price']; ?></h3>
						</td>
						<td align="center">
							<h3>$<?= number_format($value['item_price']*$value['item_quantity'],2); ?></h3>
						</td>
						<td align="center"><a href="?action=delete&id=<?= $value['item_id']; ?>" class="btn btn-danger rounded-pill btn-sm">Remove</a></td>
					</tr>
					<?php $total = $total + ($value['item_price']*$value['item_quantity']); ?>	
				<?php endforeach; ?>
				<tr>
					<td colspan="3" align="right"><strong>Total</strong></td>
					<td colspan="2" ><h1>$<?= number_format($total,2); ?></h1></td>
					
				</tr>
				<tr>
					<td colspan="5" align="right">
						<h3><a href="cart.php?action=empty" class="btn btn-warning rounded-pill">Empty cart</a> <a href="index.php" class="btn btn-primary rounded-pill">Continue Shopping</a> 
						<?php if (isset($_SESSION['email'])) : ?>
							<a href="checkout.php" class="btn btn-danger rounded-pill">Place Order</a></h3>
						<?php else: ?>
							<a href="login.php" class="btn btn-danger rounded-pill">Login to place order</a></h3>
						<?php endif; ?>
					</td>
				</tr>
		</table>

	<?php endif; ?>
