<?php

include_once("database.class.php");
	class Comment
	{
		private $m_sComment;

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
			}
		}

		public function __get($p_sProperty)
		{
			switch ($p_sProperty) {
				case 'Comment':
					return $this->m_sComment;
					break;
			}
		}

		public function AddComment()
		{
			session_start();
			$db = new Database();
			//$_SESSION['username'] = $u['first_name']." ".$u['last_name'];
			list($firstname, $lastname) = split(' ', $_SESSION['username']);
			
			$addComm = "insert into tblComments (comment, firstName, lastName, postSubject, postMention) 
						values ('".$db->conn->real_escape_string($this->m_sComment)."', '".$firstname."', '".$lastname."', '".$_SESSION['subject']."', '".$_SESSION['mention']."');";
			$db->conn->query($addComm);
		}

		public function ShowComments()
		{
			session_start();
			$db = new Database();

			$getComm = "select * from tblComments where postSubject= '".$_SESSION['subject']."' and postMention= '".$_SESSION['mention']."';";
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