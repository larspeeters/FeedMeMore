<?php
include_once("database.class.php");
	class Post
	{
		private $m_sSubject;
		private $m_sMention;
		private $m_sText;
		private $m_iID;
		
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
					$this->m_iID = $p_vValue;
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
					return $this->m_iID;
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
			echo $sql;
			$db->conn->query($sql);
		}

		public function show()
			{
				$db = new Database();

				$sql = "select * from tblPost p join tblUsers u on p.user_id = u.id order by p.id desc";
				if(isset($_GET['id']))
					$sql = $sql. " WHERE p.id ='".$_GET['id']."'";
				if(!empty($this->m_iID))
					$sql = $sql . " WHERE p.user_id ='".$this->m_iID."'";
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