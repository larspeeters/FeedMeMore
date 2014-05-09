<!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Mijn profiel | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
    <link rel="icon" type="images/png" href="images/favicon.ico">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>

<?php
include_once "includes/nav.include.php";
?>
<div id="container">
<?php
if(isset($_SESSION)):
	if($_SESSION["admin"])
		echo "<span>[Administrator]</span>" ?>
	<h2>Profiel van <?php echo $_SESSION['username']; 	if(substr($_SESSION['avatar'],0,7) != "http://"){?></h2>
    <img src="<?php echo "../images/avatars/".$_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } else{ ?> 
    <img src="<?php echo $_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } ?>
    <ul>
    	<li>Gebruikersnaam: <?php echo $_SESSION['username'];?></li>
        <li>Email: <?php echo $_SESSION['email'];?></li>
		<li><span id="password">Wachtwoord wijzigen</span>
        <div id="frmPassword" >
        	<form action=# method= >
            <label for="oudWachtwoord">Huidig wachtwoord: </label>
            <input type="text" size="25" name="oldPass" /><br />
            <label for="nieuwWachtwoord">Nieuw wachtwoord: </label>
            <input type="text" size="25" name="newPass" /><br />
            <label for="herhaalWachtwoord">Herhaal wachtwoord: </label>
            <input type="text" size="25" name="repPass" />
            </form>
            </div>
        </li>
    </ul>
<?php else: header("Location: error.php"); endif;?>
</div>
</body>
<script>
$('#password').click(function () {
        $('#frmpassword').slideDown();
    });
</script>
</html>
