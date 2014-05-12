<?php
	
	$feedback = "";
	if (!empty($_POST))
	{
		try
		{
			session_start();
			include('classes/post.class.php');
			$post = new Post();
			$post->Subject = $_POST['subject'];
			$post->Mention = $_POST['mention'];
			$post->Text = $_POST['text'];
			$post->uId = $_SESSION['id'];
			
			$post->Save();
			$feedback = "Dank u voor u medewerking! U verzending word zo snel mogelijk bekeken.";
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
	<title>Post je verbetering of klacht | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
	<link rel="icon" type="image/png" href="images/favicon.ico">
</head>

<body>
<?php
include_once "includes/nav.include.php";
?>

	<article>
    <h1>Post</h1>
    <div id="leftCol">
        <h2>Voor je een post plaatst</h2>
        <p>Feed Me More werd georganiseerd om naar de studenten hun klachten en verbeteringen te luisteren. We willen dit op een zo
        	respectvolle manier doen. Indien wij merken dat je blijvend misbruik maakt van onze website, hebben wij het recht om je account te sluiten, en indien
        	nodig ook meteen te verwijderen. Gelieve daarom eerst de <a href="rules.php">regels</a> te lezen alvorens een post te plaatsen, om problemen
        	en misverstanden te vermijden. <br><br>Met grote dank van het Feed Me More team!
        </p>

    </div>
		<div id="post">
			<h2>Verzend je post</h2>
            <form action="" method="post">
            	<label>Onderwerp*</label><br><br>
            	<input type="text" name="subject"></input><br><br>
                <label>Meld een*</label><br><br>
                <select name="mention">
                  <option value="verbetering">Verbetering</option>
                  <option value="klacht">Klacht</option>
                </select><br><br>
                <label>Leg uit*</label><br><br>
                <textarea rows="4" cols="50" name="text"></textarea><br><br>
                <input type="submit" value="Laat het ons weten!">      
            </form>
            <br>
            <div class="feedback">
				<?php 
				if(isset($error))
				{
					echo $error;
				}
				else
				{
					echo $feedback;
				}
				?>	
			</div>
        </div>
	</article>
   <?php
         include_once "includes/footer.include.php";
 ?>
</body>
</html>
