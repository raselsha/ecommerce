
<?php

	class Category extends connection{
		
		public function all_category(){
			$con = $this->con();
			$sql="SELECT * FROM category";
			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function single_category($id){
			$con = $this->con();
			$sql="SELECT * FROM category WHERE id = '$id' ";
			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function add_category($data){
			$con = $this->con();
			$category = $this->secure($data['category']);
			$category_desc = $this->secure($data['category_desc']);
			
			$sql = "INSERT into category(category,category_desc)values('$category','$category_desc')";
			
			if (mysqli_query($con,$sql)) {
				$message = '<small class="green">Data has been saved!</small>';
			}
			else{
				echo mysqli_error($con);
			}
			return $message;
		}

		public function update_category($data){
			$id = base64_decode($_GET['id']);
			$con = $this->con();
			
			$category = $this->secure($data['category']);
			$category_desc = $this->secure($data['category_desc']);

			$sql = "UPDATE category SET category='$data[category]',category_desc='$data[category_desc]' WHERE id = '$id' ";
			if (mysqli_query($con,$sql)) {
				$message = '<small class="green">Data has been updated!</small>';
			}
			else{
				echo mysqli_error($con);
			}
			return $message;
		}

		public function delete_category($id)
		{
			$con = $this->con();
			$sql = "DELETE FROM category WHERE id = '$id' ";
			if (mysqli_query($con,$sql)) {
				header('location:category.php');
			}
		}

	}

?>