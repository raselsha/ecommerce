
<?php
		
	class products extends connection{
		
		public function all_products($limit,$offset){
			$con = $this->con();
			$sql="SELECT products.*,category.category,type.type_name 
			FROM products,category,type
			WHERE products.category_id = category.id and products.type_id=type.id ORDER BY products.name asc LIMIT $limit OFFSET $offset ";
			if (mysqli_query($con,$sql)) {
				$result = mysqli_query($con,$sql);
				return $result;	
			}
			else{
				die(mysqli_error($con));
			}
					
		}

		public function all_products_by_cat($cid,$limit,$offset){
			$con = $this->con();
			$sql="SELECT products.*,category.category,type.type_name 
			FROM products,category,type
			WHERE products.category_id = category.id and products.type_id = type.id and products.category_id = '$cid' LIMIT $limit OFFSET $offset";
			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function all_products_search($search,$limit,$offset){
			$con = $this->con();
			$sql="SELECT products.*,category.category,type.type_name 
			FROM products,category,type
			WHERE products.category_id = category.id and products.type_id = type.id and products.name LIKE '%$search%' ORDER BY products.name 
			ASC LIMIT $limit OFFSET $offset";

			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function single_product($id){
			$con = $this->con();
			$sql="SELECT products.*,category.category,type.type_name 
			FROM products,category,type
			WHERE products.category_id = category.id and products.type_id = type.id and products.id='$id'";
			$result = mysqli_query($con,$sql);
			return $result;			
		}


		public function add_product($data){
			$con = $this->con();
			$name = $this->secure($data['name']);
			$unit = $this->secure($data['unit']);
			$price = $this->secure($data['price']);
			$type_id = $data['type_id'];
			$category_id = $data['category_id'];
			
			$image_name = strtolower($_POST['image_name']);
			$image_path = $_POST['image_path'];

			$sql = "INSERT INTO products(name,unit,price,type_id,image,category_id)values('$name','$unit','$price','$type_id','$image_name','$category_id')";
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

		public function duplicate_product($id){
			$con = $this->con();
			
			$sql="SELECT * FROM products WHERE id = '$id'";
			$result = mysqli_query($con,$sql);
			$data = mysqli_fetch_assoc($result);
			
			$name = $data['name'];
			$unit = $data['unit'];
			$price = $data['price'];
			$image_name = $data['image'];
			$type_id = $data['type_id'];
			$category_id = $data['category_id'];

			$sql = "INSERT INTO products(name,unit,price,type_id,image,category_id)values('$name','$unit','$price','$type_id','$image_name','$category_id')";

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

		public function update_product($data){
			$con = $this->con();
			$id = base64_decode($_GET['id']);
			
			$name = $this->secure($data['name']);
			$unit = $this->secure($data['unit']);
			$price = $this->secure($data['price']);
			$type_id = $data['type_id'];
			$category_id = $data['category_id'];

			$sql = "UPDATE products SET name='$name',unit='$unit',price='$price',type_id='$type_id',category_id='$category_id' WHERE id = '$id'";

			if ($_POST['image_name']!='') {

				$result = $this->single_product($id);
				$row=mysqli_fetch_assoc($result);
				$image='../assets/admin/upload/'.$id.'_'.$row['image'];
				if (file_exists($image)) {
					unlink($image);
				}

				$sql = "UPDATE products SET image = '$_POST[image_name]' WHERE id = '$id' ";
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

		public function delete_product($id)
		{
			$con = $this->con();
			$result = $this->single_product($id);
			$row=mysqli_fetch_assoc($result);
			$image='../assets/admin/upload/'.$id.'_'.$row['image'];
			unlink($image);
			$sql = "DELETE FROM products WHERE id = '$id' ";

			
			if (mysqli_query($con,$sql)) {
				header('location:products.php');
			}

		}
// ========================= count =========================//

		public function products_row_count()
		{
			$con = $this->con();
			$sql = "SELECT * FROM products";
			$result = mysqli_query($con,$sql);
			return 12;
		}

		public function products_row_count_by_id($id)
		{
			$con = $this->con();
			$sql = "SELECT * FROM products WHERE category_id = '$id' ";
			$result = mysqli_query($con,$sql);
			return mysqli_num_rows($result);
		}

		public function products_search_row_count($search)
		{
			$con = $this->con();
			$sql = "SELECT * FROM products WHERE name_en LIKE '%$search%' ";
			$result = mysqli_query($con,$sql);
			return mysqli_num_rows($result);
		}
	}

?>