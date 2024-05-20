<?php
	class model{
		private $conn;

		//inisialisasi awal untuk class biasa disebut instansiasi
		function __construct(){
			// create connection
			$this->conn = new mysqli("localhost", "root", "", "osghs_mvc");
			// Check connection
			if ($this->conn->connect_error) {
				die("Connection failed: ". $this->conn->connect_error);
			}
			//$connect = mysql_connect("localhost", "root", "");
			//$db = mysql_select_db("osghs_mvc");
		}
		
		function execute($query) {
			$result = $this->conn->query($query);
			if (!$result) {
				echo "Error executing query: " . $this->conn->error;
				return false;
			}
			return true;
		}
		
		function selectAll() {
			$query = "SELECT * FROM tblhiring"; 
			$result = $this->conn->query($query);
			if ($result) {
				return $result->fetch_all(MYSQLI_ASSOC);
			} else {
				echo "Error: " . $this->conn->error;
				return false;
			}
		}
	}
?>