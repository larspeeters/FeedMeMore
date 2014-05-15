<!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Home | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="icon" type="image/png" href="images/favicon.ico">
</head>

<body>
<?php
	include_once "includes/nav.include.php";
	include('classes/post.class.php');
	include('classes/comment.class.php');
	if(isset($_POST['submitComment']))
	{
		try
		{
			$comm = new Comment();
			$comm->Comment = $_POST['textComment'];	
			$comm->User = $_SESSION['username'];	
			$comm->Mention = $_POST['mention'];
			$comm->Subject = $_POST['subject'];
			$comm->AddComment();
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}

?>
   
	<article>
	<?php			
		$p = new Post();
		$p->pId= $_GET['id'];
		$s = $p->show();
		
    	echo "<div id='detailPost'><h2>".$s[0]['subject']."</h2><h3>".$s[0]['mention']."</h3><p>".$s[0]['text']."</p></div>";
    	echo "<hr>";
		
		$getComm = new Comment();
		$getComm->Subject = $s[0]['subject'];
		$getComm->Mention = $s[0]['mention'];
		$comments = $getComm->ShowComments();
    	
	    echo "<div id='commentList'>";
	    if(isset($comments)){
	      foreach($comments as $listComments){
	       	echo "<div class='comments'><p>".htmlspecialchars($listComments['comment'])."</p><p class='postedBy'>gepost door ".$listComments['firstName']." ".$listComments['lastName']."</p></div>";
	       	}
	    }
	    echo "</div>";
	if($_SESSION['username'] != ""){
	?>
	<form name="formComment" method="post" action="">
    	<input type="text" hidden="hidden" value="<?php echo $s[0]['subject']; ?>" name="subject" />
        <input type="text" hidden="hidden" value="<?php echo $s[0]['mention']; ?>" name="mention" />
		<textarea name="textComment" placeholder="Voeg hier uw reactie."></textarea>
		<input type="submit" name="submitComment" id="submitComment" value="plaats reactie"></input>
	</form>
	<?php
	}
	else
	{
		?>
		<form>
		<textarea placeholder="Meld je aan om een reactie te plaatsen" disabled></textarea>
		</form>
		<?php
	}
		if(isset($error)){ echo "<div id='error'>".$error."<div>"; }
	?>
	</article>
</body>
</html>
