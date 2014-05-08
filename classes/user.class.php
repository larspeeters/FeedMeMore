<?php
	include_once("database.class.php");
	
	class User
	{
		private $m_iID;
		private $m_sFirstname;
		private $m_sLastname;
		private $m_sPassword;
		private $m_sEmail;
		private $m_sAvatar;
		
		public function __set($p_sProperty, $p_vValue)
		{
			switch ($p_sProperty) 
			{
				case 'Id':	$this->m_iID = $p_vValue; break;				
				case 'Firstname': 
					if(empty($p_vValue))
						throw new Exception("Gelieve een voornaam in te vullen. ");
					else
						$this->m_sFirstname = $p_vValue; break;
				case 'Lastname': 
					if(empty($p_vValue))
						throw new Exception("Gelieve een familienaam in te vullen.");
					else
						$this->m_sLastname = $p_vValue; break;
				case 'Password': 
					if(empty($p_vValue))
						throw new Exception("Gelieve een wachtwoord in te vullen.");
					else
						$this->m_sPassword = $p_vValue; break;
				case 'Email': 
					if(empty($p_vValue))
						throw new Exception("Gelieve een email adres in te vullen.");
					else{
						if(substr($p_vValue,0,1) == 'r' && strlen($p_vValue) == 30)
							$this->m_sEmail = $p_vValue;
						else
							throw new Exception("Gelieve een geldig email adres in te vullen. (Vb. rxxxxxxx)");
					}
					$this->m_sEmail = $p_vValue; break;
				case 'Avatar': $this->m_sAvatar = $p_vValue; break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) {
				case 'Id':	return $this->m_iID; break;				
				case 'Firstname': return $this->m_sFirstname; break;
				case 'Lastname': return $this->m_sLastname; break;
				case 'Password': return $this->m_sPassword; break;
				case 'Email': return $this->m_sEmail; break;
				case 'Avatar': return $this->m_sAvatar; break;
			}
		}
		
		private function hashed($password){
				$salt = "Imd123)";
				$hash = md5($password.$salt);
				return $hash;				
		}

		public function Save()
		{
			try{
				if(substr($this->m_sAvatar,0,7) != "http://" && !empty($this->m_sAvatar))
					$this->uploadImage();
				$db = new Database();
				$hashed = md5( rand(0,1000) );
				$sql = "insert into tblUsers (first_name, last_name, password, email, avatar, isAdmin, hash) values ('".$db->conn->real_escape_string($this->m_sFirstname)."', 
																		  '".$db->conn->real_escape_string($this->m_sLastname)."', 
																		  '".$db->conn->real_escape_string($this->hashed($this->m_sPassword))."',
																		  '".$db->conn->real_escape_string($this->m_sEmail)."',
																		  '".$db->conn->real_escape_string($this->m_sAvatar)."',
																		  0,'".$db->conn->real_escape_string($hashed)."');";
			$db->conn->query($sql);
			mysqli_close($db->conn); //close connection with Dbase
			$this->activateAccount($this->m_sEmail, $hashed);
			}catch(Exception $e){
				echo $e->getMessage();
			}
				}
			
		public function getUser()
		{
			$db = new Database();
			$sql = "Select * from tblUsers where email='".$db->conn->real_escape_string($this->m_sEmail)."'";
			if(!empty($this->m_sPassword))
				$sql = $sql. " AND password='".$db->conn->real_escape_string($this->hashed($this->m_sPassword))."'";
			if($result = $db->conn->query($sql)){
			 $array = mysqli_fetch_array($result);
				//query went OK
				if(!empty($array))
					return $array;
				else
					return false;
			}
			mysqli_close($db->conn); //close connection with Dbase
		}
		public function changePassword()
		{
			try{
			$db = new Database();
			$sql = "UPDATE tblUsers SET password='".$db->conn->real_escape_string($this->hashed($this->m_sPassword))."' WHERE email='".$db->conn->real_escape_string($this->m_sEmail)."'";
			$db->conn->query($sql);
			mysqli_close($db->conn); //close connection with Dbase
			}catch(Exception $e){
				echo $e->getMessage();
			}
			mysqli_close($db->conn); //close connection with Dbase
		}
	private function activateAccount($email, $hash){
		$to      = $this->m_sEmail; 
		$subject = 'Account activatie'; 
		$message = '
		 
		Bedankt voor het registreren!
		Om gebruik te kunnen maken van uw account, dient uw deze te activeren via onderstaande link:
		http://www.yourwebsite.com/activate.php?email='.$email.'&hash='.$hash.'
		
		Uw inloggegevens
		------------------------
		Gebruikersnaam: '.$this->m_sEmail.'
		Wachtwoord: '.$this->m_sPassword.'
		------------------------

		'; // Our message above including the link
							 
		$headers = 'From: Feed Me More' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email	
	}
	private function uploadImage(){
		// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
		// of $_FILES.
		if(!empty($_FILES)){
			if(filesize($_FILES['avatar']['tmp_name']) <= 512000){
				$uploaddir = '/images/avatars/';
				$uploadfile = $uploaddir."avatar_". basename(substr($this->m_sEmail,0,7)).substr($_FILES['avatar']['name'],strpos($_FILES['avatar']['name'],"."));
				define ('SITE_ROOT', realpath(dirname(substr($this->m_sEmail,0,7))));
				if (!move_uploaded_file($_FILES['avatar']['tmp_name'], SITE_ROOT.$uploadfile)) {
					throw new Exception("Avatar mag niet groter zijn dan 500KB.");
				}else{
					$this->m_sAvatar = "avatar_". basename(substr($this->m_sEmail,0,7)).substr($_FILES['avatar']['name'],strpos($_FILES['avatar']['name'],"."));
				}
			}else{
				throw new Exception("Avatar mag niet groter zijn dan 500KB.");
			}
	}
}
	}

?>