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
						if(substr($p_vValue,0,1) == 'r')
							$this->m_sPassword = $p_vValue;
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
				$db = new Database();
			
				$sql = "insert into tblUsers (first_name, last_name, password, email, avatar, isAdmin) values ('".$db->conn->real_escape_string($this->m_sFirstname)."', 
																		  '".$db->conn->real_escape_string($this->m_sLastname)."', 
																		  '".$db->conn->real_escape_string($this->hashed($this->m_sPassword))."',
																		  '".$db->conn->real_escape_string($this->m_sEmail)."',
																		  '".$db->conn->real_escape_string($this->m_sAvatar)."',
																		  0);";
			$this->uploadImage();
			$db->conn->query($sql);
			}catch(Exception $e){
				echo $e->getMessage();
			}
				}
			
		public function getUser($id)
		{
			
		
		}
	private function uploadImage(){
		// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
		// of $_FILES.
		if(!empty($_FILES)){
			if(filesize($_FILES['avatar']['tmp_name']) <= 512000){
				$uploaddir = '/images/';
				$uploadfile = $uploaddir . basename($_FILES['avatar']['name']);
				define ('SITE_ROOT', realpath(dirname($_FILES['avatar']['name'])));
				if (!move_uploaded_file($_FILES['avatar']['tmp_name'], SITE_ROOT.$uploadfile)) {
					throw new Exception("Avatar mag niet groter zijn dan 500KB.");
				}
			}else{
				throw new Exception("Avatar mag niet groter zijn dan 500KB.");
			}
	}
}
	}

?>