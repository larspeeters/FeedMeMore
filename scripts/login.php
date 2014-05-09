<?php
	include ("../classes/user.class.php");
	if(isset($_POST)){
		if(isset($_POST['username']) && isset($_POST['password'])){
			try{
				$usr = new User();
				$usr->Password = $_POST['password'];
				$usr->Email = $_POST['username']."@student.thomasmore.be";
				$u = $usr->getUser();	
				if(!empty($u)){
					if($u['activated']){
						session_start();
						$_SESSION['id'] = $u['Id'];
						$_SESSION['username'] = $u['first_name']." ".$u['last_name'];
						$_SESSION['email'] = $u['email'];
						$_SESSION['avatar'] = $u['avatar'];
						$_SESSION['admin'] = $u['isAdmin'];
						header( 'Location: ../index.php' );
					}else{
						header("Location: ../activate.php");
					}
				}
			}	
			catch(Exception $e)
			{
				header( 'Location: ../index.php?error='.$e->getMessage() );
			}		
		}

		if(isset($_POST['email'])){
			$usr = new User();
			$usr->Email = $_POST['email']."@student.thomasmore.be";
			if($usr->getUser())
				echo true;
		}
	}
?>