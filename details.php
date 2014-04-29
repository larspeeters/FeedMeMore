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
	<?php
		$p = new Post();
		$p->Id = $_GET['id'];
		$s = $p->ShowSpecific();
    	echo "<div id='detailPost'><h2>".$s['subject']."</h2><h3>".$s['mention']."</h3><p>".$s['text']."</p></div>";
	?>
	</article>
</body>
</html>
