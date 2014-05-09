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
	<h2>Profiel van <?php echo $_SESSION['username']; 	if(empty($_SESSION['avatar'])){ ?>
     <span><img src="<?php echo "../images/avatars/icon.jpg" ?>" width="50px" height="50px" title="Profielfoto" /><br />
	<?php }else if(substr($_SESSION['avatar'],0,7) != "http://"){?></h2>
     
     <img src="<?php echo "../images/avatars/".$_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } else{ ?> 
    <img src="<?php echo $_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } ?><br />
    <ul>
    	<li>Gebruikersnaam: <?php echo $_SESSION['username'];?></li><br />
        <li>Email: <?php echo $_SESSION['email'];?></li><br />
		<li><span id="password">Wachtwoord wijzigen</span><br /><br />
       
        <div id="frmPassword" >
        	<form action=# method= >
            <div id="leftProfile">
            <label for="oudWachtwoord">Huidig wachtwoord: </label><br />
            <label for="nieuwWachtwoord">Nieuw wachtwoord: </label><br />
            <label for="herhaalWachtwoord">Herhaal wachtwoord: </label>
            </div>
            <input type="text" size="25" name="oldPass" /><br />
            <input type="text" size="25" name="newPass" /><br />
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
