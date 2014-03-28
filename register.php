<!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Registreren | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
<?php 

// filename: upload.form.php 

// first let's set some variables 

// make a note of the current working directory relative to root. 
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']); 

// make a note of the location of the upload handler script 
$uploadHandler = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . '/images/'.$_POST['avatar']; 

// set a max file size for the html upload form 
$max_file_size = 30000; // size in bytes 

// now echo the html page 
if(!empty($_POST['avatar'])){
@move_uploaded_file($_POST['avatar'], $uploadHandler);
}
include_once "includes/nav.include.php";
?>
<div id="container"> 
	<form action="" method="POST" id="register">
    	<fieldset>
        	<legend>Nieuwe gebruiker registeren</legend>
            <label for="firstname">Voornaam: </label> <input type="text" size="50" name="firstname" /><br />
            <label for="lastname">Familienaam: </label> <input type="text" size="50" name="lastname" /><br />
            <label for="password">Wachtwoord: </label> <input type="password" size="50" name="password" id="password" /><br />
            <label for="passwordRep">Herhaal wachtwoord: </label> <input type="password" size="50" name="passwordRep" id="passwordRep" /><span id="passwordmatch" style="color:red;"> </span><br />
            <label for="email">Email: </label> <input type="text" size="8" maxlength="8" name="email" id="mail"/>@student.thomasmore.be<br />
            <label for="avatar" >Avatar: </label><img src="images/avatar.png" alt="Your avatar" title="Kies een avatar" width="75" height="75" /> <br /><input type="file" name="avatar" /><br />
            <input type="submit" value="Registreren" id="btnRegister" />
        </fieldset>
    </form>
</div>
</body>
<script>
$(document).ready(function(e) {
    $("#passwordRep").keypress(function(e) {
        if($("#passwordRep").val() != $("#password").val()){
			$("#passwordmatch").html("Wachtwoorden komen niet overeen.");
		}
		else{$("#passwordmatch").html("");}
    });
});

</script>
</html>
