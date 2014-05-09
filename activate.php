<?php
	include ("classes/database.class.php");
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
		$db = new Database();	
		$sql = "SELECT email, hash, activated FROM tblUsers WHERE email='"
				.$db->conn->real_escape_string($_GET['email'])."' AND hash='"
				.$db->conn->real_escape_string($_GET['hash'])."' AND activated='0'";

		if($result = $db->conn->query($sql)){
			$array = $result->num_rows;
			if($array == 1){
				$db = new Database();	
				$sql = "UPDATE tblUsers SET activated='1' WHERE email='"
						.$db->conn->real_escape_string($_GET['email'])."' AND hash='"
						.$db->conn->real_escape_string($_GET['hash'])."' AND activated='0'";
				if($db->conn->query($sql))
					header("Location: index.php");
			}
		}
	}else{
		//account not yet activated ?>
       <!DOCTYPE HTML>
        <html lang="nl">
        <head>
            <meta charset="utf-8">
            <title>Home | Feed Me More</title>
            <link rel="stylesheet" type="text/css" href="css/reset.css">
            <link rel="stylesheet" type="text/css" href="css/screen.css">
            <link rel="icon" type="image/png" href="images/favicon.ico">
        </head>
        
        <body>
        <?php
        include_once "includes/nav.include.php";
        if(isset($_GET['activate'])): ?>
        <div id="message" > 
        	<p>Bedankt voor uw registratie! U kan uw account activeren door de link aan te klikken die naar het opgegeven emailadres (<?php echo $_GET['activate']; ?>) werd gestuurd.</p>
        </div>
        <?php endif; ?>
        </body>
        </html>

<?php		
	}
?>