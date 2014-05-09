<nav>
<?php 	session_start(); ?>
    <div id="logo">
                <a href="index.php"><img src="images/logowit.png" width="150" height="70" alt="logo"></a>
            </div>
		<div id="main">
			<ul>
				<li><a href="index.php">posts</a></li>
                <?php if(isset($_SESSION['username'])): ?>
                <li><a href="post.php">post zelf iets</a></li>
                <?php endif; ?>
				<li><a href="about.php">wie zijn we</a></li>
				<li><a href="rules.php">regels</a></li>
				<li><a href="contact.php">bereik ons</a></li>
			</ul>
		</div>
<?php
	if(isset($_GET['logout'])){
		session_start();
		session_destroy();
		header("Location: index.php");
	}
		if(!isset($_SESSION['username'])):?>
		<div id="login">
	        <form action="/scripts/login.php" method="post" name="login">
		        <input type="text" size="8" maxlength="8" placeholder="Studentennummer" name="username" />
		        <input type="password" size="20" placeholder="Wachtwoord" name="password" />
		        <input type="submit" name="loginSend" value="login"></input>
	        </form>
	        <?php
	        if(isset($_GET))
	        {
		        echo "<div class='errorMessage'>".$_GET['error']."</div>";
	    	}
	        ?>
	        <a href="register.php" id="Register" >Registreren</a>
		</div>
<?php else: ?>
	<div id="logout">
     <?php  if(empty($_SESSION['avatar'])){ ?>
     <span><img src="<?php echo "../images/avatars/icon.jpg" ?>" width="50px" height="50px" title="Profielfoto" />
	<?php }else if(substr($_SESSION['avatar'],0,7) != "http://"){?>
    		<span><img src="<?php echo "../images/avatars/".$_SESSION['avatar']; ?>" width="50px" height="50px" title="Profielfoto" />  <?php } else { ?> 
            <span><img src="<?php echo $_SESSION['avatar']; ?>" width="50px" height="50px" title="Profielfoto" /> <?php } ?><a href="../profile.php" ><?php echo $_SESSION['username'];?></a></span>
	        <a href="?logout=true" >[ Log out ] </a>
		</div>
<?php endif; ?>
	</nav>