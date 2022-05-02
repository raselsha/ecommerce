
<?php

	class Type extends connection{
		
		public function all_type(){
			$con = $this->con();
			$sql="SELECT * FROM type";
			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function single_type($id){
			$con = $this->con();
			$sql="SELECT * FROM type WHERE id = '$id' ";
			$result = mysqli_query($con,$sql);
			return $result;
		}

		public function add_type($data){
			$con = $this->con();
			$type_name = $this->secure($data['type_name']);
			$sql = "INSERT into type(type_name)values('$type_name')";
			if (mysqli_query($con,$sql)) {
				$message = '<small class="green">Data has been saved!</small>';
			}
			else{
				echo mysqli_error($con);
			}
			return $message;
		}

		public function update_type($data){
			$id = base64_decode($_GET['id']);
			$con = $this->con();
			$type_name = $this->secure($data['type_name']);
			$sql = "UPDATE type SET type_name='$type_name' WHERE id = '$id' ";
			if (mysqli_query($con,$sql)) {
				$message = '<small class="green">Data has been updated!</small>';
			}
			else{
				echo mysqli_error($con);
			}
			return $message;
		}

		public function delete_type($id)
		{
			$con = $this->con();
			$sql = "DELETE FROM type WHERE id = '$id' ";
			if (mysqli_query($con,$sql)) {
				header('location:type.php');
			}
		}

	}

?>