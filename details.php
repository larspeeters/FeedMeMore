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
    if($n){
      foreach($n as $list){
        echo "<div id='list'><div class='topPost'><h2>".$list['subject']. " | </h2><h3>" .$list['mention']. "</h3></div><p>" .$list['text']."</p></div>";
        echo "<div class='movie_choice'>
                  <div id='".$list['id']."' class='rate_widget'>
                      <div class='star_1 ratings_stars'></div>
                      <div class='star_2 ratings_stars'></div>
                      <div class='star_3 ratings_stars'></div>
                      <div class='star_4 ratings_stars'></div>
                      <div class='star_5 ratings_stars'></div>
                      <div id='votes'>
                        <div class='total_votes'>vote data</div>
                      </div>
                  </div>
              </div><hr>";
      }
      if (!empty($_POST['remove']))
      {
        $r = new Post();
        $r->remove();
      }
    }

?>-->
	</article>
</body>
</html>
