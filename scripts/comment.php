<?php
	include ("../classes/comment.class.php");
	if(isset($_POST))
	{
		try
		{
			$comm = new Comment();
			$comm->Comment = $_POST['textComment'];	
			$comm->User = $_POST['username'];	
			$comm->Mention = $_POST['mention'];
			$comm->Subject = $_POST['subject'];
			$comm->AddComment();
			
			$row = $comm->ShowComments();
			$count = sizeof($row);
			
			echo "<div class='comments'><p>".$row[($count-1)]['comment']."</p><p class='postedBy'>gepost door ".$row[($count-1)]['firstName']." ".$row[($count-1)]['lastName']."</p></div>";	
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?>