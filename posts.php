<?php
	include('classes/post.class.php');
?><!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Verbeteringen en klachten | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
</head>

<body>
<?php
include_once "includes/nav.include.php";
?>
   
	<article>
		<?php 
		echo "test";
    $p = new Post();
    $n = $p->show();
    if($n){
      foreach($n as $list){
        echo "<div id='list'>".$list['subject']. " " .$list['mention']. " " .$list['text']." </div>";
      }
      if (!empty($_POST['remove']))
      {
        $r = new Post();
        $r->remove();
      }
    }

?>
	
	</article>
</body>
</html>
