<?php
	class Post
	{
		private $m_sSubject;
		private $m_sMention;
		private $m_sText;		
		private $m_iId;
		// gewijzigd
		public function __set($p_sProperty, $p_vValue)
		{
			switch ($p_sProperty) 
			{
				case 'Subject':
				if(empty($p_vValue)){
					throw new Exception("geef een onderwerp");
				}
					$this->m_sSubject = $p_vValue;
					break;
				
				case 'Mention':
				if(empty($p_vValue)){
					throw new Exception("maak een keuze");
				}
					$this->m_sMention = $p_vValue;
					break;
					
				case 'Text':
				if(empty($p_vValue)){
					throw new Exception("geef uitleg");
				}
					$this->m_sText = $p_vValue;
					break;

				case 'Id':
					$this->m_iId = $p_vValue;
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) {
				case 'Subject':
					return $this->m_sSubject;
					break;

				case 'Mention':
					return $this->m_sMention;
					break;

				case 'Text':
					return $this->m_sText;
					break;

				case 'Id':
					return $this->m_iId;
					break;
			}
		}

		public function Save()
		{
			$mysql_host = "mysql1.000webhost.com";	
			$mysql_user = "a8154344_php";
			$mysql_password = "Imd123)";
			$mysql_database = "a8154344_imd";

			$conn  = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
			$sql = "insert into tblPost (subject, mention, text) values ('".$conn->real_escape_string($this->m_sSubject)."', 
																	  '".$conn->real_escape_string($this->m_sMention)."', 
																	  '".$conn->real_escape_string($this->m_sText)."');";
			$conn->query($sql);
		}

		public function show()
			{
				$mysql_host = "mysql1.000webhost.com";	
				$mysql_user = "a8154344_php";
				$mysql_password = "Imd123)";
				$mysql_database = "a8154344_imd";

				$conn = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);
				$sql = "select * from tblPost order by id desc";
				
				if(!empty($this->m_iId))
					$sql += "Where ID ='".$this->m_iId."'";
				
				print_r($sql);
				$result = mysqli_query($conn,$sql);
				$array = array();
				
				while($row = mysqli_fetch_array($result)){
					array_push($array, $row);
					}
				
				return $array;
			}
	}

?>