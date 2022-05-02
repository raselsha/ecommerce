	<?php 
		$name = '';
		$er_name = '';
		$email = '';
		$er_email = '';
		$phone = '';
		$er_phone = '';
		$city = '';
		$er_city = '';
		$address = '';
		$er_address = '';
		$er = 0;
		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];

			if (empty($_POST['name'])) {
				$er_name = '<span class="red">required</span>';
				$er++;
			}
			if (empty($_POST['email'])) {
				$er_email = '<span class="red">required</span>';
				$er++;
			}
			if (empty($_POST['phone'])) {
				$er_phone = '<span class="red">required</span>';
				$er++;
			}
			if (empty($_POST['city'])) {
				$er_city = '<span class="red">required</span>';
				$er++;
			}
			if (empty($_POST['address'])) {
				$er_address = '<span class="red">required</span>';
				$er++;
			}
			if ($er==0) {
				if (empty($_POST['ship_to_name'])) {
					$_POST['ship_to_name'] = $name;
				}
				if (empty($_POST['ship_to_email'])) {
					$_POST['ship_to_email'] = $email;
				}
				if (empty($_POST['ship_to_phone'])) {
					$_POST['ship_to_phone'] = $phone;
				}

				$_POST['amount'] = intval($_POST['amount']);
				$pay->gen_invoice($_POST);				
			}
		}

	 ?>
	<?php  if (!empty($_SESSION['shoppig_cart'])): ?>
		<div class="row">
			<div class="col-md-12 my-4">
				<h2 class="text-primary text-center">Your order has been placed successfully!</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<h2>Summery</h2>
				<table width="100%" class="table table-striped">
					<tr>
						<th align="left">Item name</th>
						<th align="left">Sub Total</th>
					</tr>

					<?php 
						$total = 0;
						foreach ($_SESSION['shoppig_cart'] as $key => $value):?>
							<tr>
								<td><?= $value['item_name']; ?> x <?= $value['item_quantity']; ?>
									
								</td>
								<td>$<?= number_format($value['item_price']*$value['item_quantity'],2); ?></td>
							</tr>
							<?php $total = $total + ($value['item_price']*$value['item_quantity']); ?>	
						<?php endforeach; ?>
						<tr>
							<td align="right"><strong>Total</strong></td>
							<td>
								<strong>$<?= number_format($total,2); ?></strong>
							</td>
						</tr>

				</table>
				<?php 

					unset($_SESSION['shoppig_cart']);
				 ?>
				 <a href="index.php?action=empty" class="btn btn-warning rounded-pill">Back to home</a>
			</div>
			
		</div>
		
	<?php endif; ?>
