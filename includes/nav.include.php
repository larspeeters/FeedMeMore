	<nav>
    <div id="logo">
                <img src="images/logowit.png" width="150" height="70" alt="logo">
            </div>

		<div id="main">
			<ul>
				<li><a href="index.php">home</a></li>
				<li><a href="posts.php">posts</a></li>
                <li><a href="post.php">post zelf iets</a></li>
				<li><a href="about.php">wie zijn we</a></li>
				<li><a href="rules.php">regels</a></li>
				<li><a href="contact.php">bereik ons</a></li>
			</ul>
		</div>
<?php session_start();
		if(!isset($_SESSION['username'])):?>
		<div id="login">
	        <form action="" method="post" name="login">
		        <input type="text" size="20" placeholder="Username" name="username" />
		        <input type="password" size="20" placeholder="Password" name="password" />
		        <input type="button" name="loginSend" value="login"></input>
	        </form>

	        <form action="" method="post" name="registreer"> 
		        <input type="button" name="registerSend" value="registreer"></input>
	        </form>
		</div>
<?php endif;?>
	</nav>