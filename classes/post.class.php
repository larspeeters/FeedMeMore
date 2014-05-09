<?php
include_once("database.class.php");
	class Post
	{
		private $m_sSubject;
		private $m_sMention;
		private $m_sText;
		private $m_iUID;
		private $m_iPID;
		
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
				case 'pId':
					$this->m_iPID = $p_vValue;
					break;
				case 'uId':
					$this->m_iUID = $p_vValue;
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
				case 'pId':
					return $this->m_iPID;
					break;
				case 'uId':
					return $this->m_iUID;
					break;
			}
		}

		public function Save()
		{
			$db = new Database();

			$sql = "insert into tblPost (subject, mention, text, user_Id) values ('".$db->conn->real_escape_string($this->m_sSubject)."', 
																	  '".$db->conn->real_escape_string($this->m_sMention)."', 
																	  '".$db->conn->real_escape_string($this->m_sText)."',
																	  '".$db->conn->real_escape_string($this->m_iID)."');";

			$db->conn->query($sql);
		}

		public function show()
			{
				$db = new Database();

				$sql = "select * from tblPost p join tblUsers u on p.user_id = u.id";
				if(!empty($this->m_iPID))
					$sql = $sql. " WHERE p.id ='".$this->m_iPID."'";
				if(!empty($this->m_iUID))
					$sql = $sql . " WHERE p.user_id ='".$this->m_iID."'";
				
				$sql = $sql. " order by p.id desc";
				$array = array();
				if($result = $db->conn->query($sql)){
					
			 	while($row = mysqli_fetch_array($result)){
					array_push($array, $row);
					}
			}
			mysqli_close($db->conn);
			return $array;
			}
	}

?>