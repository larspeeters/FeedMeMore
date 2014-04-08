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
				case 'Firstname': $this->m_sFirstname = $p_vValue; break;
				case 'Lastname': $this->m_sLastname = $p_vValue; break;
				case 'Password': $this->m_sPassword = $p_vValue; break;
				case 'Email': $this->m_sEmail = $p_vValue; break;
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

		public function Save()
		{
			$db = new Database();
			$sql = "insert into tblUsers (first_name, last_name, password, email, avatar, isAdmin) values ('".$db->conn->real_escape_string($this->m_sFirstname)."', 
																	  '".$db->conn->real_escape_string($this->m_sLastname)."', 
																	  '".$db->conn->real_escape_string($this->m_sPassword)."',
																	  '".$db->conn->real_escape_string($this->m_sEmail)."',
																	  '".$db->conn->real_escape_string($this->m_sAvatar)."',
																	  0);";
			$db->conn->query($sql);
				}
		
		public function getUser($id)
		{
			
		
		}
	}

?>