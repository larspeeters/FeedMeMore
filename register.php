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
<?php include_once "includes/nav.include.php";
		include_once "classes/user.class.php";

		if(!empty($_POST)){
			$usr = new User();
			$usr->Firstname = $_POST['firstname'];
			$usr->Lastname = $_POST['lastname'];
			$usr->Password = $_POST['password'];
			$usr->Email = $_POST['email']."@student.thomasmore.be";
			
			$usr->Save();
		}
?>

<div id="container"> 
	<form action="" method="POST" enctype="multipart/form-data" id="register">
    	<fieldset>
        	<legend>Nieuwe gebruiker registeren</legend>
            <label for="firstname">Voornaam: </label> <input type="text" size="50" name="firstname" /><br />
            <label for="lastname">Familienaam: </label> <input type="text" size="50" name="lastname" /><br />
            <label for="password">Wachtwoord: </label> <input type="password" size="50" name="password" id="password" /><br />
            <label for="passwordRep">Herhaal wachtwoord: </label> <input type="password" size="50" name="passwordRep" id="passwordRep" /><span id="passwordmatch" style="color:red;"> </span><br />
            <label for="email">Email: </label> <input type="text" size="8" maxlength="8" name="email" id="mail"/>@student.thomasmore.be<br />
            <label for="avatar" >Avatar: </label><img src="images/avatar.png" alt="Your avatar" title="Kies een avatar" width="75" height="75" id="avatar"/> <br />
            <input type="file" name="avatar" id="file" /><br />
            <input type="text" name="gravatar" id="gravatar" /><input type="button" id="image" value="Get gravatar" /><br />
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
	$("#file").change(function(){
		if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#avatar").attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
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
          }
       });

    }
)
});

</script>
</html>
