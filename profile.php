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
include "classes/post.class.php";
?>
<div id="container">
<?php
if(isset($_SESSION)):
	if($_SESSION["admin"])
		echo "<span>[Administrator]</span>" ?>
	<h2>Profiel van <?php echo $_SESSION['username']; 	if(empty($_SESSION['avatar'])){ ?>
     <span><img src="<?php echo "../images/avatars/icon.jpg" ?>" width="50px" height="50px" title="Profielfoto" />
	<?php }else if(substr($_SESSION['avatar'],0,7) != "http://"){?></h2>
    <img src="<?php echo "../images/avatars/".$_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } else{ ?> 
    <img src="<?php echo $_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } ?>
    <ul>
    	<li>Gebruikersnaam: <?php echo $_SESSION['username'];?></li>
        <li >Email: <span id="mail"><?php echo $_SESSION['email'];?></span></li>
		<li><span id="password">Wachtwoord wijzigen</span>
        <div id="frmPassword" >
        	<form id="form">
            <label for="nieuwWachtwoord">Nieuw wachtwoord: </label>
            <input type="password" size="25" id="newPass" /><br />
            <label for="herhaalWachtwoord">Herhaal wachtwoord: </label>
            <input type="password" size="25" id="repPass" /><br />
            <input type="button" value="Wijzigen" id="btnChange" /> <span id="passwordFeedback"> </span>
            </form>
            </div>
        </li>
    </ul>
 <?php $p = new Post();
 		$p->uId = $_SESSION['id'];
		$list = $p->show(); 
		if(!empty($list)):?>
        <ul id="userPosts">
    	<span>Uw aangemaakte posts:</span>
        <?php foreach($list as $row){?>
        	<li><a href="details.php?id=<?php echo $row['id'] ?>"><?php echo $row['subject']." (".$row['mention'].")"; ?></a></li>
<?php  } ?> </ul><?php endif;
	else: header("Location: error.php"); endif;?>
</div>
</body>
<script>
$(document).ready(function () {
	if($("#repPass").val() == ""){
		$("#btnChange").attr("disabled", "disabled");
	}
    $('#password').click(function () {
        $('#frmPassword').slideToggle(300);
    });
	$('#btnChange').click(function () {
        $.ajax({
          url: "scripts/passwordChange.php",
          type: "POST",
		  data: {"email": $("#mail").text(), "password": $('#newPass').val()},
          success: function(data){
              $('#passwordFeedback').html(data);
          }
       });
    });
	$("#repPass").keyup(function(e) {
        if($("#repPass").val() != $("#newPass").val()){
			$("#btnChange").attr("disabled", "disabled");
			$("#passwordFeedback").html("Wachtwoorden komen niet overeen.");
		}
		else{$("#passwordFeedback").html("");
		$("#btnChange").removeAttr("disabled"); }
    });
});
</script>
</html>
