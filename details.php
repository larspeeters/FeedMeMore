<?php
	include('classes/post.class.php');
?><!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Home | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="icon" type="image/png" href="images/favicon.ico">
	<!--<link rel="icon" href="images/favicon.ico" type="image/x-icon" />-->
</head>

<body>
<?php
include_once "includes/nav.include.php";
?>
   
	<article>
		<!-- HIER WORD NOG AAN GEWERKT -->
	<?php 
    $p = new Post();
    $n = $p->show();
    echo "<div id='detailPost'><h2>".$n['subject']."</h2><h3>".$n['mention']."</h3><p>".$n['text']."</p></div>"
?>
	</article>
</body>
</html>
