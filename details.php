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
</head>

<body>
<?php
include_once "includes/nav.include.php";
?>
   
	<article>
		<!-- HIER WORD NOG AAN GEWERKT -->
	<?php 
    $p = new Post();
    $p->Id = $_GET['id'];
    $p->show();
    var_dump($p);
    echo "<div id='detailPost'><h2>".$p['subject']."</h2><h3>".$p['mention']."</h3><p>".$p['text']."</p></div>"
?>
	</article>
</body>
</html>
