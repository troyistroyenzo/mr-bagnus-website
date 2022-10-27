<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "mrbangus";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function addToCart($customerId,$productId,$quantity){
		$sql = "INSERT INTO cart (customer_id, product_id, quantity)
		VALUES ('" . $customerId . "', '" . $productId . "', '" . $quantity . "')";

		if ($this->conn->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error";
		}
	}

	function deleteFromCart($productId){
		$sql = "DELETE FROM CART WHERE product_id='" . $productId . "'";

		if ($this->conn->query($sql) === TRUE) {
			echo "Record deleted successfully";
		} else {
			echo "Error";
		}
	}

}
?>