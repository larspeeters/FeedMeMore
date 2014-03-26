<!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Registreren | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
</head>

<body>
<?php
include_once "includes/nav.include.php";
?>
<div id="container"> 
	<form action="" method="POST" id="register">
    	<fieldset>
        	<legend>Nieuwe gebruiker registeren</legend>
            <label for="firstname">Voornaam: </label> <input type="text" size="50" name="firstname" /><br />
            <label for="lastname">Familienaam: </label> <input type="text" size="50" name="lastname" /><br />
            <label for="password">Wachtwoord: </label> <input type="password" size="50" name="password" /><br />
            <label for="passwordRep">Herhaal wachtwoord: </label> <input type="password" size="50" name="passwordRep" /><br />
            <label for="email">Email: </label> <input type="text" size="50" name="email" /><br />
            <label for="avatar" >Avatar: </label> <input type="file" name="avatar" /><br />
            <input type="submit" value="Registreren" id="btnRegister" />
        </fieldset>
    </form>
</div>
</body>
</html>
