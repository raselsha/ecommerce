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
		<form method="post" action="" >
		<table class="table">
			<tr>
				<td valign="top">
					<h2>Billing Info</h2>
					<label>Full name</label><br>
					<input type="text" name="name" value="<?= $name; ?>"> <?= $er_name; ?><br>
					
					<label>Email address</label><br>
					<input type="text" name="email" value="<?= $email; ?>"> <?= $er_email; ?><br>
					
					<label>Mobile number</label><br>
					<input type="text" name="phone" value="<?= $phone; ?>"> <?= $er_phone; ?><br>

					<label>City</label><br>
					<input type="text" name="city" value="<?= $city; ?>"> <?= $er_city; ?><br>
					<label>Address</label><br>
					<textarea type="text" name="address"><?= $address; ?></textarea> <?= $er_address; ?><br>
				</td>
				<td valign="top">
					<h2>Shipping Address</h2>
					<label>Full name</label><br>
					<input type="text" name="ship_to_name"><br>
					<label>Mobile number</label><br>
					<input type="text" name="ship_to_phone"><br>
					<label>City</label><br>
					<input type="text" name="ship_to_city"><br>
					<label>Address</label><br>
					<textarea type="text" name="ship_to_address"></textarea><br>
				</td>

				<td valign="top">
					<h2>Your order</h2>
					<table width="100%" class="table table-striped">
						<tr>
							<th align="left">Item name</th>
							<th align="left">Sub Total</th>
						</tr>

						<?php 
							$total = 0;
							foreach ($_SESSION['shoppig_cart'] as $key => $value):?>
								<tr>
									<td><?= $value['item_name_en']; ?> x <?= $value['item_quantity']; ?>
										
									</td>
									<td><?= number_format($value['item_price_en']*$value['item_quantity'],2); ?></td>
								</tr>
								<?php $total = $total + ($value['item_price_en']*$value['item_quantity']); ?>	
							<?php endforeach; ?>
							<tr>
								<td align="right"><strong>Total</strong></td>
								<td>
									<strong><?= number_format($total,2); ?></strong>
									<input type="hidden" name="amount" value="<?= $total; ?>">
								</td>
							</tr>

					</table>
					<p><input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="Pay Now">
					</p>
				</td>
			</tr>
		</table>
	</form>
	<?php endif; ?>
