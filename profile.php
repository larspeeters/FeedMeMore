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
include "classes/comment.class.php";
?>
<div id="containerRegister">
  <div id="userProfile">
<?php
if(isset($_SESSION)):
	if($_SESSION["admin"])
		echo "<span>[Administrator]</span>"; ?>
	<legend>Profiel van <?php echo $_SESSION['username']; 	if(empty($_SESSION['avatar'])){ ?>
     <img src="<?php echo "../images/avatars/icon.jpg" ?>" id="profilePic" width="50px" height="50px" title="Profielfoto" />
	<?php }else if(substr($_SESSION['avatar'],0,7) != "http://"){?>
    <img src="<?php echo "../images/avatars/".$_SESSION['avatar']; ?>" id="profilePic" width="100px" height="100px" title="Profielfoto" /><?php } else{ ?> 
    <img src="<?php echo $_SESSION['avatar']; ?>" width="100px" height="100px" title="Profielfoto" /><?php } ?>
    </legend><div class="ar login_popup">
    <div class="popup">
        <span>Mijn avatar wijzigen</span><br/>
        <img src="images/avatars/icon.jpg"  alt="Your avatar" title="Kies een avatar" width="75" height="75" id="avatar" /> <br/>
        <input type="file" name="avatar" id="file" value="Avatar wijzigen" /><input type="button" value="wijzigen" id="btnAvatar" />
    </div>
</div>
    <ul>
    	<li>Gebruikersnaam: <?php echo $_SESSION['username'];?></li>
        <li>Email: <span id="mail"><?php echo $_SESSION['email'];?></span></li>
		<li><span id="password">Wachtwoord wijzigen</span>
        <div id="frmPassword" >
        	<form id="form">
            <div id="frmpasswordleft">
            <label for="nieuwWachtwoord">Nieuw wachtwoord: </label><br />
            <label for="herhaalWachtwoord">Herhaal wachtwoord: </label><br />
            <input type="button" value="Wijzigen" id="btnChange" /> <span id="passwordFeedback"> </span>
            </div>
            <input type="password" size="25" id="newPass" />
            <input type="password" size="25" id="repPass" />
            
            </form>
            </div>
        </li>
    </ul>
 <?php $p = new Post();
 		$p->uId = $_SESSION['id'];
		$list = $p->show(); 
		if(!empty($list)):?>
        <br><ul id="userPosts">
    	<span>Uw aangemaakte posts:</span><br /><br />
        <?php foreach($list as $row){
			$c = new Comment();
			$c->Subject = $row['subject'];
			$c->Mention = $row['mention'];
			$rows = $c->ShowComments();?>
        	<li><a href="details.php?id=<?php echo $row['id'] ?>"><div id="userMadePosts"><?php echo $row['subject']." (".$row['mention'].")"; ?> - </div><?php echo "<div id='icon'>" .count($rows);?> <img src="images/comment.png" width="15px" height="15px" title="Commentaar"/></div></a></li>
<?php  } ?> </ul><?php endif;
	else: header("Location: error.php"); endif;?>
</div></div>
<?php
        include_once "includes/footer.include.php";
 ?>

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
	$("#profilePic").click(function(e) {
		if($(".popup").css('display') == 'block'){
			 $(".popup, .overlay").hide(); 
		}else{
        $("body").append(''); $(".popup").show(); 
		}
    }); 
	$("#file").change(function(){
		if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#avatar").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
	});
	$('#btnAvatar').click(
    function(){
		var url = $('#file').val().split("\\");
        $.ajax({
          url: "scripts/passwordChange.php",
          type: "POST",
		  data: {"avatar": url[2]},
          success: function(data){
				alert(data);
          }
       });

    });
});
</script>
</html>
