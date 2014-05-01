<?php
	include_once("database.class.php");

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
			$db = new Database();

			$sql = "insert into tblPost (subject, mention, text) values ('".$db->conn->real_escape_string($this->m_sSubject)."', 
																	  '".$db->conn->real_escape_string($this->m_sMention)."', 
																	  '".$db->conn->real_escape_string($this->m_sText)."');";
			$db->conn->query($sql);
		}

		public function Show()
			{
				
				$db = new Database();

				$sql = "select * from tblPost order by id desc";

				$result = $db->conn->query($sql);
				$array = array();
				
				while($row = mysqli_fetch_array($result)){
					array_push($array, $row);
					}
				
				return $array;
			}

		public function ShowSpecific()
		{
			$db = new Database();
			$sql = "select * from tblPost where id='" . $_GET["id"] ."' order by id desc";

			if($result = $db->conn->query($sql))
			{
				$array = mysqli_fetch_array($result);
				if(!empty($array))
				{
					return $array;
				}
				else
				{
					echo "Deze pagina bestaat niet.";
				}
				mysqli_close($db->conn);
			}
		}
	}

?>