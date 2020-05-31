<?php

	class connection
	{
		public $link;
		public $value;

		public function con()
		{
			$host_name = 'localhost';
			$user_name = 'shahahbr_root';
			$password = 'one1two2';
			$db_name = 'shahahbr_ecommerce';
			$this->link = mysqli_connect($host_name,$user_name,$password,$db_name);
			
			$con = $this->link;
			mysqli_query($con,'SET CHARACTER SET utf8');
			mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");
			
			if (!$this->link) {
				echo "Database not connect!".mysqli_error($this->link);
			}
			return $con;
			
		}

		public function secure($value)
		{
			$value = mysqli_real_escape_string($this->con(),strip_tags($value));
			return $value;
		}
	}

?>