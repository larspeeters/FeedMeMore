<?php
	include ("../classes/user.class.php");
	if(isset($_POST)){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$usr = new User();
			$usr->Password = $_POST['password'];
			$usr->Email = $_POST['username']."@student.thomasmore.be";
			if(!$usr->getUser()){
				echo "Login failed";
			}else{
				$u = $usr->getUser();
				session_start();
				$_SESSION['id'] = $u['id'];
				$_SESSION['username'] = $u['first_name']." ".$u['last_name'];
				$_SESSION['email'] = $u['email'];
				$_SESSION['avatar'] = $u['avatar'];
				header( 'Location: ../index.php' ) ;
			}			
		}
	}
?>