<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Login Form</title>
	<link rel="stylesheet" href="css/stylex.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style>
.w3-button {width:80px;}
</style>
	
</head>
<body>
	<div class="box">
	<form action="signindata.php" method="post">
	<div id="close-login-form" class="fas fa-times"></div>
		<?php if (isset($_SESSION['error'])) { ?>
			<div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
				<?php } ?>
				<?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
			<h2>Sign in</h2>
			<div class="inputBox">
			<input type="email" class="form-control" name="email" aria-describedby="email" required="required">
				<span>Userame</span>
				<i></i>
			</div>
			<div class="inputBox">
			
			<input type="password" class="form-control" name="password" required="required">
				<span>Password</span>
				<i></i>
			</div>
			<div class="links">
				
			<p>Don't have account <a href="register.php">Click Here</a></p>
			</div>
			<P><button type="submit" name="signin" class="w3-button w3-purple">Sign in</button></P>
		</form>
	</div>
</body>
</html>