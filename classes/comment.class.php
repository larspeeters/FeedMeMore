<?php

include_once("database.class.php");
	class Comment
	{
		private $m_sComment;
		private $m_sSubject;
		private $m_sMention;
		private $m_sUsername;

		public function __set($p_sProperty, $p_vValue)
		{
			switch ($p_sProperty) 
			{
				case 'Comment':
				if(empty($p_vValue)){
					throw new Exception("vul iets in!");
				}
					$this->m_sComment = $p_vValue;
					break;
				case 'Subject':
					$this->m_sSubject = $p_vValue;
					break;
				case 'Mention':
					$this->m_sMention = $p_vValue;
					break;
				case 'User':
					$this->m_sUsername = $p_vValue;
					break;
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) {
				case 'Comment':
					return $this->m_sComment;
					break;
				case 'Mention':
					return $this->m_sMention;
					break;
				case 'Subject':
					return $this->m_sSubject;
					break;
				case 'User':
					return $this->m_sUsername;
					break;
			}
		}

		public function AddComment()
		{
			$db = new Database();
			list($firstname, $lastname) = explode(' ', $this->m_sUsername);
			
			$addComm = "insert into tblComments (comment, firstName, lastName, postSubject, postMention) 
						values ('".$db->conn->real_escape_string($this->m_sComment)."', '".$db->conn->real_escape_string($firstname)
						."', '".$db->conn->real_escape_string($lastname)."', '".$db->conn->real_escape_string($this->m_sSubject)."', '".$db->conn->real_escape_string($this->m_sMention)."');";
			$db->conn->query($addComm);
		}

		public function ShowComments()
		{
			$db = new Database();

			$getComm = "select * from tblComments where postSubject= '".$db->conn->real_escape_string($this->m_sSubject)."' and postMention= '".$db->conn->real_escape_string($this->m_sMention)."';";
			$getCommResult = $db->conn->query($getComm);
			$arrayComment = array();
			
			if($getCommResult = $db->conn->query($getComm)){
					
			 while($commentRow = mysqli_fetch_array($getCommResult)){
					array_push($arrayComment, $commentRow);
					}
			}
			mysqli_close($db->conn);
			return $arrayComment;
		}
	}

?>