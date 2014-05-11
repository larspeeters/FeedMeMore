<?php
	include('classes/post.class.php');
	include('classes/comment.class.php');
	if(isset($_POST['submitComment']))
	{
		try
		{
			$comm = new Comment();
			$comm->Comment = $_POST['textComment'];			
			$comm->AddComment();
		}
		catch(Exception $e)
		{
			$error = $e->getMessage();
		}
	}
?><!DOCTYPE HTML>
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
?>
   
	<article>
	<?php
		session_start();
				
		$p = new Post();
		$p->pId= $_GET['id'];
		$s = $p->show();
		
    	echo "<div id='detailPost'><h2>".$s[0]['subject']."</h2><h3>".$s[0]['mention']."</h3><p>".$s[0]['text']."</p></div>";
    	echo "<hr>";
    	
    	$_SESSION['subject'] = $s[0]['subject'];
    	$_SESSION['mention'] = $s[0]['mention'];

		$getComm = new Comment();

		$comments = $getComm->ShowComments();
    	
	    echo "<div id='commentList'>";
	    if(isset($comments)){
	      foreach($comments as $listComments){
	       	echo "<div class='comments'><p>".$listComments['comment']."</p><p class='postedBy'>gepost door ".$listComments['firstName']." ".$listComments['lastName']."</p></div>";
	       	}
	    }
	    echo "</div>";
	if($_SESSION['username'] != ""){
	?>
	<form name="formComment" method="post" action="">
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
	<?php
        include_once "includes/footer.include.php";
    ?>
	</article>
</body>
</html>
