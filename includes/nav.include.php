<nav>
<?php $page = $_SERVER["SCRIPT_NAME"];
	$page = explode("/", $page);	
	$page = array_reverse($page);		
	$page = $page[0];
session_start(); ?>
    <div id="logo">
                <a href="index.php"><img src="images/logowit.png" width="150" height="70" alt="logo"></a>
            </div>
		<div id="main">
			<ul>
				<li><a href="index.php" <?php echo ($page == 'index.php') ? 'class="active"' : '';?>>posts</a></li>
                <?php if(isset($_SESSION['username'])): ?>
                <li><a href="post.php" <?php echo ($page == 'post.php') ? 'class="active"' : '';?>>post zelf iets</a></li>
                <?php endif; ?>
				<li><a href="about.php" <?php echo ($page == 'about.php') ? 'class="active"' : '';?>>wie zijn we</a></li>
				<li><a href="rules.php" <?php echo ($page == 'rules.php') ? 'class="active"' : '';?>>regels</a></li>
				<li><a href="contact.php" <?php echo ($page == 'contact.php') ? 'class="active"' : '';?>>bereik ons</a></li>
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
	        if(isset($_GET['error']))
	        {
		        echo "<div class='errorMessage'>".$_GET['error']."</div>";
	    	}
	        ?>
	        <a href="register.php" id="Register" >Registreren</a>
		</div>
<?php else: ?>
	<div id="logout">
     <?php  if(empty($_SESSION['avatar'])){ ?>
     <img src="<?php echo "../images/avatars/icon.jpg" ?>" width="50px" height="50px" title="Profielfoto" />
	<?php }else if(substr($_SESSION['avatar'],0,7) != "http://"){?>
    		<img src="<?php echo "../images/avatars/".$_SESSION['avatar']; ?>" width="50px" height="50px" title="Profielfoto" />  <?php } else { ?> 
            <img src="<?php echo $_SESSION['avatar']; ?>" width="50px" height="50px" title="Profielfoto" /> <?php } ?><div id="nameLogout"><ul><li><a href="../profile.php" ><?php echo $_SESSION['username'];?></a></li>
	        <li><a href="?logout=true" >[ Log out ] </a></li></ul></div>
		</div>
<?php endif; ?>
	</nav>