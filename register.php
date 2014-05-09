<!DOCTYPE HTML>
<html lang="nl">
<head>
	<meta charset="utf-8">
	<title>Registreren | Feed Me More</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/screen.css">
    <link rel="icon" type="images/png" href="images/favicon.ico">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
<?php  include("classes/user.class.php");
include("includes/nav.include.php");
		$error = "";
		if(!empty($_POST)){
			if(empty($_POST['username'])){
			try{
			$usr = new User();
			$usr->Firstname = $_POST['firstname'];
			$usr->Lastname = $_POST['lastname'];
			$usr->Password = $_POST['password'];
			$usr->Email = $_POST['email']."@student.thomasmore.be";
			if(!empty($_FILES['avatar']['name']) || !empty($_POST['gravatar'])){
				if(empty($_FILES['avatar']['name']))
					$usr->Avatar = $_POST['linkgrav'];
				else{
					$usr->Avatar = $_FILES['avatar']['name'];}
			}
			if($usr->Save())
				header("Location: activate.php?email=".$usr->Email);
			}catch(Exception $e){
				$error = $e->getMessage();
			}
			}
		}
?>

<div id="containerRegister"> 
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" id="formregister">
    	<fieldset>
        	<legend>Nieuwe gebruiker registreren</legend>
            <span id="error" ><?php echo $error ?></span><br/>
            <div id="leftRegister"><label for="firstname">Voornaam: </label> <br />
            <label for="lastname">Familienaam: </label> <br />
            <label for="password">Wachtwoord: </label> <br />
            <label for="passwordRep">Herhaal wachtwoord: </label><br />
            <label for="email">Email: </label><br /> </div>
            
            <input type="text" size="50" name="firstname" /><br />
            <input type="text" size="50" name="lastname" /><br />
            <input type="password" size="50" name="password" id="password" /><span id="passwordCheck" style="color:red;"> </span><br />
            <input type="password" size="50" name="passwordRep" id="passwordRep" /><span id="passwordmatch" style="color:red;"> </span><br />
            <input type="text" size="8" maxlength="8" name="email" id="mail"/>@student.thomasmore.be<span id="emailCheck" style="color:red;"> </span><br /><br />
            <label for="avatar" >Avatar: </label><img src="images/avatar.png" alt="Your avatar" title="Kies een avatar" width="75" height="75" id="avatar" /> <br /><br />
            <input type="file" name="avatar" id="file" /><br /><br />
            Of Gravatar (<a href="http://nl.gravatar.com/">?</a>):
            <input type="text" name="gravatar" id="gravatar" /><input type="button" id="image" value="Get gravatar" /><input type="text" hidden="hidden" name="linkgrav" id="link"/><br /><br />
            <input type="submit" value="Registreren" id="btnRegister" /> <input type="button" value="Velden leegmaken" id="formreset" />
        </fieldset>
    </form>
     
</div>
</body>
<script>
$(document).ready(function(e) {
	$('#formreset').click(function(){
        $("#formregister").get(0).reset();
  });
  $("#password").keyup(function(e) {
	  	if($("#password").val().length < 8){
			$("#passwordCheck").html("Wachtwoorden moet minimum 8 characters bevatten.");
			$("input[type='submit']").attr("disabled", "disabled");
		}else{
			$("#passwordCheck").html("");
			$("input[type='submit']").removeAttr("disabled"); 
		}
	  	});
    $("#passwordRep").keyup(function(e) {
        if($("#passwordRep").val() != $("#password").val()){
			$("input[type='submit']").attr("disabled", "disabled");
			$("#passwordmatch").html("Wachtwoorden komen niet overeen.");
		}
		else{$("#passwordmatch").html("");
		$("input[type='submit']").removeAttr("disabled"); }
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
	$("#mail").keyup(function(e) {
		if($("#mail").val().length == 8){
		$.ajax({
          url: "scripts/login.php",
          type: "POST",
		  data: {"email": $("#mail").val()},
          success: function(data){
              if(data){
			  	$("#emailCheck").html("Emailadres is reeds geregistreerd.");
				$("input[type='submit']").attr("disabled", "disabled");}
			  else{
				  $("#emailCheck").html("");
					$("input[type='submit']").removeAttr("disabled");
				}
          }
		  });
		}
	});
	
	$('#image').click(
    function(){
       $.ajax({
          url: "scripts/gravatar.php",
          type: "POST",
		  data: {"gravatar": $("#gravatar").val()},
          success: function(data){
              $("#avatar").attr("src", data);
			   $("#link").val(data);
          }
       });

    }
)

});

</script>
</html>
