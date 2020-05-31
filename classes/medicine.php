
<?php
		
	class medicine extends connection{
		
		public function all_medicine($limit,$offset){
			$con = $this->con();
			$sql="SELECT medicine.*,category.category,type.type_name 
			FROM medicine,category,type
			WHERE medicine.category_id = category.id and medicine.type_id=type.id ORDER BY medicine.name_en asc LIMIT $limit OFFSET $offset ";
			if (mysqli_query($con,$sql)) {
				$result = mysqli_query($con,$sql);
				return $result;	
			}
			else{
				die(mysqli_error($con));
			}
					
		}

		public function all_medicine_by_cat($cid,$limit,$offset){
			$con = $this->con();
			$sql="SELECT medicine.*,category.category,type.type_name 
			FROM medicine,category,type
			WHERE medicine.category_id = category.id and medicine.type_id = type.id and medicine.category_id = '$cid' LIMIT $limit OFFSET $offset";
			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function all_medicine_search($search,$limit,$offset){
			$con = $this->con();
			$sql="SELECT medicine.*,category.category,type.type_name 
			FROM medicine,category,type
			WHERE medicine.category_id = category.id and medicine.type_id = type.id and medicine.name_en LIKE '%$search%' ORDER BY medicine.name_en 
			ASC LIMIT $limit OFFSET $offset";

			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function single_medicine($id){
			$con = $this->con();
			$sql="SELECT medicine.*,category.category,type.type_name 
			FROM medicine,category,type
			WHERE medicine.category_id = category.id and medicine.type_id = type.id and medicine.id='$id'";
			$result = mysqli_query($con,$sql);
			return $result;			
		}


		public function add_medicine($data){
			$con = $this->con();

			$name = $this->secure($data['name']);
			$name_en = $this->secure($data['name_en']);
			$name_grp = $this->secure($data['name_grp']); 
			$used = $this->secure($data['used']);
			$unit = $this->secure($data['unit']);
			$price = $this->secure($data['price']);
			$price_en = $this->secure($data['price_en']);
			$instruction = $this->secure($data['instruction']); 
			$prescribe = $this->secure($data['prescribe']);
			$type_id = $data['type_id'];
			$category_id = $data['category_id'];
			
			$image_name = strtolower($_POST['image_name']);
			$image_path = $_POST['image_path'];

			$sql = "INSERT INTO medicine(name,name_en,name_grp,used,unit,price,price_en,type_id,instruction,prescribe,image,category_id)values('$name','$name_en','$name_grp','$used','$unit','$price','$price_en','$type_id','$instruction','$prescribe','$image_name','$category_id')";
			if (mysqli_query($con,$sql)) {
				$id = mysqli_insert_id($con);
				$sp = $image_path; 
				$dp = '../assets/admin/upload/'.$id.'_'.$image_name;
				move_uploaded_file($sp,$dp);

				$message = '<small class="green">Data saved!</small>';
				return $message;
			}
			else{
				echo mysqli_error($con);
			}
		}

		public function duplicate_medicine($id){
			$con = $this->con();
			
			$sql="SELECT * FROM medicine WHERE id = '$id'";
			$result = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($result);
			
			$name = $data['name'];
			$name_en = $data['name_en'];
			$name_grp = $data['name_grp']; 
			$used = $data['used'];
			$unit = $data['unit'];
			$price = $data['price'];
			$price_en = $data['price_en'];
			$instruction = $data['instruction']; 
			$prescribe = $data['prescribe'];
			$image_name = $data['image'];
			$type_id = $data['type_id'];
			$category_id = $data['category_id'];

			$sql = "INSERT INTO medicine(name,name_en,name_grp,used,unit,price,price_en,type_id,instruction,prescribe,image,category_id)values('$name','$name_en','$name_grp','$used','$unit','$price','$price_en','$type_id','$instruction','$prescribe','$image_name','$category_id')";

			if ($image_name != '') {
					if (mysqli_query($con,$sql)) {

						$last_id = mysqli_insert_id($con);
						
						$sp = '../assets/admin/upload/'.$id.'_'.$image_name; 
						$dp = '../assets/admin/upload/'.$last_id.'_'.$image_name;
						if (!copy($sp, $dp)) {
						    echo "failed to copy";
						}
						$message = '<small class="green">Data duplicated!</small>';
						return $message;
					}
			}
			else{
				if (mysqli_query($con,$sql)) {
					$message = '<small class="green">Data duplicated!</small>';
					return $message;
				}
				else{
					echo mysqli_error($con);
				}
			}
		}

		public function update_medicine($data){
			$con = $this->con();
			$id = base64_decode($_GET['id']);
			
			$name = $this->secure($data['name']);
			$name_en = $this->secure($data['name_en']);
			$name_grp = $this->secure($data['name_grp']); 
			$used = $this->secure($data['used']);
			$unit = $this->secure($data['unit']);
			$price = $this->secure($data['price']);
			$price_en = $this->secure($data['price_en']);
			$instruction = $this->secure($data['instruction']); 
			$prescribe = $this->secure($data['prescribe']);
			$type_id = $data['type_id'];
			$category_id = $data['category_id'];

			$sql = "UPDATE medicine SET name='$name',name_en='$name_en',name_grp='$name_grp',used='$used',unit='$unit',price='$price',price_en='$price_en',type_id='$type_id',instruction='$instruction',prescribe='$prescribe',category_id='$category_id' WHERE id = '$id'";

			if ($_POST['image_name']!='') {

				$result = $this->single_medicine($id);
				$row=mysqli_fetch_assoc($result);
				$image='../assets/admin/upload/'.$id.'_'.$row['image'];
				if (file_exists($image)) {
					unlink($image);
				}

				$sql = "UPDATE medicine SET image = '$_POST[image_name]' WHERE id = '$id' ";
				$sp = $_POST['image_path']; 
				$dp = '../assets/admin/upload/'.$id.'_'.$_POST['image_name'];
				move_uploaded_file($sp,$dp);
			}

			if (mysqli_query($con,$sql)) {
				$message = '<small class="green">Data update!</small>';
				return $message;
			}
			else{
				echo mysqli_error($con);
			}
		}

		public function delete_medicine($id)
		{
			$con = $this->con();
			$result = $this->single_medicine($id);
			$row=mysqli_fetch_assoc($result);
			$image='../assets/admin/upload/'.$id.'_'.$row['image'];
			unlink($image);
			$sql = "DELETE FROM medicine WHERE id = '$id' ";

			
			if (mysqli_query($con,$sql)) {
				header('location:medicine.php');
			}

		}
// ========================= count =========================//

		public function medicine_row_count()
		{
			$con = $this->con();
			$sql = "SELECT * FROM medicine";
			$result = mysqli_query($con,$sql);
			return mysqli_num_rows($result);
		}

		public function medicine_row_count_by_id($id)
		{
			$con = $this->con();
			$sql = "SELECT * FROM medicine WHERE category_id = '$id' ";
			$result = mysqli_query($con,$sql);
			return mysqli_num_rows($result);
		}

		public function medicine_search_row_count($search)
		{
			$con = $this->con();
			$sql = "SELECT * FROM medicine WHERE name_en LIKE '%$search%' ";
			$result = mysqli_query($con,$sql);
			return mysqli_num_rows($result);
		}
	}

?>