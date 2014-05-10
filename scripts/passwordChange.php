<?php
	if(isset($_POST)){
    	try{
			include ("../classes/user.class.php");
			$user = new User();
			$user->Email = $_POST['email'];
			$user->Password = $_POST['password']; 	
			
			if($user->changePassword()){
				echo "Uw wachtwoord is gewijzigd.";
			}else{
				echo "Wijzigen mislukt.";
			}
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
?>