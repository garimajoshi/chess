<?php
session_start();
?>

<!DOCTYPE html>
<html>  
<head>  
	<meta charset="utf-8">  
   	<title>Online Chess</title>  
    <meta name="description" content="Play Chess Online.">  
 	<link rel="icon" href="./favicon.ico">
    <link rel="stylesheet" href="stylesheets/reset.css">
    <link rel="stylesheet" href="stylesheets/layout.css">
   	<link rel="stylesheet" href="stylesheets/style.css">
    <style>
		body {background-image:url('./chess.jpg');}
	</style>
</head>  
    
<body> 
  	<div id="container">
        	<div id="header">
        		<div id="banner-text">ONLINE CHESS</div>
                
                <?php
					if (!isset($_SESSION['username'])) {
				?>
                
                <div id="login-button">Sign In</div>
				<div id="register-button">Register</div>
              	<div id="loginwrapper"></div>
                <div id="login-dialog">
				    <div style="padding-bottom: 20px;">Sign in</div>
				    <form method="post" action="./include/dologin.php" id="loginForm">
				        <div><input name="email" id="lemail" type="text" placeholder="Email"/></div>
				        <div><input name="password" id="lpassword" type="password" placeholder="Password"/></div>
				        <div><input name="signin" type="submit" value="Log In"/></div>
					<div><a href="#" style="text-decoration: none; font-size: 12pt; color: blue;">Forgot Password</a></div> 
				    </form>
				</div>
                
                <div id="register-dialog">
                    			<div style="padding-bottom: 20px;">Register</div>
                    			<form method="post" action="./include/dologin.php" id="registerForm">
                        			<div><input name="username" id="username" type="text" placeholder="Username"/></div>
                        			<div><input name="email" id="email" type="text" placeholder="Email"/></div>
                        			<div><input name="password" id="password" type="password" placeholder="Password"/></div>
                       				<div><input name="confirmpassword" id="confirmpassword" type="password" placeholder="Confirm Password"/></div>
                        			<div><input name="register" type="submit" value="Register"/></div>
                    			</form>
                </div>
         		
                <?php
					} else { 
				?>
                
         		<div id="logout-button"><a href="./include/logout.php">Sign Out</a></div>
				<div id="welcome-bar">
					<div>Welcome, <?php echo $_SESSION['username']; ?></div>
				</div>
                
                <?php
					}
				?>
     	  	</div>  
        </div>  
        
<script src="scripts/jquery-1.8.3.min.js"></script>
  <script src="scripts/jquery-ui-1.8.23.custom.min.js"></script>
	<script src="scripts/script.js"></script>
    <script src="scripts/jquery.mousewheel.min.js"></script>
<script type="text/javascript">

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
      
</body>  
</html>  