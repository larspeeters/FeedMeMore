<?php
	include('classes/post.class.php');
?><!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Verbeteringen en klachten | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
    <link rel="icon" type="image/png" href="images/favicon.ico">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <link rel="stylesheet" type="text/css" href="css/rating.css">
  <script>

    // This is the first thing we add ------------------------------------------
    $(document).ready(function() {
        
        $('.rate_widget').each(function(i) {
            var widget = this;
            var out_data = {
                widget_id : $(widget).attr('id'),
                fetch: 1
            };
            $.post(
                'ratings.php',
                out_data,
                function(INFO) {
                    $(widget).data( 'fsr', INFO );
                    set_votes(widget);
                },
                'json'
            );
        });
    

        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_over');
                $(this).nextAll().removeClass('ratings_vote'); 
            },
            // Handles the mouseout
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_over');
                // can't use 'this' because it wont contain the updated data
                set_votes($(this).parent());
            }
        );
        
        
        // This actually records the vote
        $('.ratings_stars').bind('click', function() {
            var star = this;
            var widget = $(this).parent();
            
            var clicked_data = {
                clicked_on : $(star).attr('class'),
                widget_id : $(star).parent().attr('id')
            };
            $.post(
                'ratings.php',
                clicked_data,
                function(INFO) {
                    widget.data( 'fsr', INFO );
                    set_votes(widget);
                },
                'json'
            ); 
        });
        
        
        
    });

    function set_votes(widget) {

        var avg = $(widget).data('fsr').whole_avg;
        var votes = $(widget).data('fsr').number_votes;
        var exact = $(widget).data('fsr').dec_avg;
    
        $(widget).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
        $(widget).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
        $(widget).find('.total_votes').text( votes + ' stem(men) ( rating ' + exact + ' )' );
    }
    // END FIRST THING
    
    </script>
</head>

<body>
<?php
include_once "includes/nav.include.php";
?>
   
	<article>
		<?php 
    $p = new Post();
    $n = $p->show();
    if($n){
      foreach($n as $list){ ?>
        <div id='list'><div class='topPost'><h2><?php $list['subject'] ?> | </h2><h3><?php $list['mention'] ?></h3></div><p><?php $list['text'] ?></p></div>";
        <div class='movie_choice'>
        <div id='<?php $list['id'] ?>' class='rate_widget'>
        <div class='star_1 ratings_stars'></div>
        <div class='star_2 ratings_stars'></div>
        <div class='star_3 ratings_stars'></div>
        <div class='star_4 ratings_stars'></div>
        <div class='star_5 ratings_stars'></div>
        <div class='total_votes'>vote data</div>
        </div>
        </div><hr>
              <?php
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
