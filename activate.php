<?php
	include ("classes/database.class.php");
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
		$db = new Database();	
		$sql = "SELECT email, hash, activated FROM tblUsers WHERE email='"
				.$db->conn->real_escape_string($_GET['email'])."' AND hash='"
				.$db->conn->real_escape_string($_GET['hash'])."' AND activated='0'";

		if($result = $db->conn->query($sql)){
			$array = $result->num_rows;
			if($array == 1){
				$db = new Database();	
				$sql = "UPDATE tblUsers SET activated='1' WHERE email='"
						.$db->conn->real_escape_string($_GET['email'])."' AND hash='"
						.$db->conn->real_escape_string($_GET['hash'])."' AND activated='0'";
				if($db->conn->query($sql))
					echo "Activated!";
			}
		}
	}else{
		// Invalid approach
	}
?>