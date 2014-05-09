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
			$post->Id = $_SESSION['id'];
			
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
        <h2>Belangrijk</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu tellus sem. Aliquam a aliquam leo. 
        Suspendisse potenti. Pellentesque malesuada semper malesuada. Donec congue porttitor felis, eu pharetra quam auctor vitae. 
        Nulla tincidunt cursus elementum. Aenean eros quam, scelerisque at fringilla eu, facilisis vitae neque. 
        <br><br>
        Quisque in odio sed nibh aliquam tincidunt in sit amet tellus. Pellentesque leo erat, semper sit amet magna facilisis, laoreet consequat est. 
        Proin euismod orci mi, ut egestas est fringilla sed.
        </p>
    </div>
		<div id="post">
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
</body>
</html>
