<?php
	
	$id = base64_decode($_GET['id']);
	$medicine = $med->single_medicine($id);
	$medi = mysqli_fetch_assoc($medicine);

?>
<h2>Medicine details</h2>
<table width="100%" align="center" border="1">
		<tr>
			<td rowspan="6" width="12%">
				<?php if($medi['image']): ?>
					<img src="../assets/admin/upload/<?= $medi['id']."_".$medi['image'] ?>" width="140">
				<?php else: ?>
					<img src="../assets/admin/image/default.jpg" width="140">
				<?php endif; ?>
			</td>
		</tr>
		<tr>
		   <td width="38%" colspan="2" align="center">
		   	<h2 class="red"><?= $medi['name']; ?></h2>
		   	<h2  class="blue line_height"><?= $medi['name_en']; ?></h2>
		   	<?php if ($medi['name_grp']):?>
		   		<p class="line_height">( <?= $medi['name_grp'] ?> )</p>
		   	<?php endif; ?>
		   </td>
		   <td rowspan="5" valign="top" width="50%">
		   		<p><strong class="sky">রোগ নির্দেশনাঃ </strong><?= $medi['instruction']; ?></p>
		   		<p><strong class="sky">সেবন বিধিঃ </strong><?= $medi['prescribe']; ?></p>
		   		<p>
		   			<?php
		   			echo '<a class="yellow_bg white padding" href="edit_medicine.php?id='.base64_encode($medi['id']).'">Edit</a>
						<a class="red_bg white padding" href="medicine.php?action=delete&&id='.base64_encode($medi['id']).'">Delete</a>';
					?>
		   		</p>
		   </td>
		</tr>
		<tr>
		   <th width="7%" align="left">Category</th>
		   <td><?= $medi['category']; ?>
		   </td>
		 </tr>
		 <tr>
		    <th width="7%" align="left">Type</th>
		    <td><?= $medi['type_name']; ?>
		    </td>
		  </tr>
		<tr>
		   <th width="7%" align="left">পরিবেশনা</th>
		   <td><?= $medi['used']." ".$medi['type_name']; ?>
		   </td>
		 </tr>
		 <tr>
		   <th align="left">খুচরা মূল্য</th>
		   <td><?= $medi['unit']." ".$medi['price']; ?></td>
		 </tr>
	</table>


<p><a href="medicine.php" class="green_bg white padding">Back</a></p>

	