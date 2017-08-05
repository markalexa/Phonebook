<?php
	session_start();
	setcookie("userID","1234",time() + 3600 * 24 * 7);
	require('sqlfunction.php');
	$success = $errMsg = "";
	
	if(isset($_POST['submit'])) {
		
		if($_POST['submit'] == "Log In") {
		
		$usernameToCheck = filter_var($_POST['usernameToCheck'],FILTER_SANITIZE_STRING);
		$passwordToCheck = filter_var($_POST['passwordToCheck'],FILTER_SANITIZE_STRING);	
		$passwordToCheck = sha1($passwordToCheck);
		
		try {
			
			$link = connectDB();
			$query = "select username from users where username = '".$usernameToCheck."' and password = '".$passwordToCheck."';";
			if($result = mysqli_query($link,$query)) {
				while($row = mysqli_fetch_assoc($result)) {
					session_start();
					$username = $usernameToCheck;
					$_SESSION['username'] = $username;
					$_SESSION['timeout'] = time();
					header("Location: loggedIn.php");
					
				}
			} 
			if($userID == false) {
				
				$message = '<div class="alert alert-danger" role="alert" id="error">
  							<p><strong>Login failed.</strong></p>Double-check your logins.</div>';
			}
		} catch (Exception $e) { echo "Request couldn't be processed"; }
		mysqli_close($link);
			

	
	} else if($_POST['submit'] == "Register") {
		
		$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  					$errMsg = '<div class="alert alert-danger" role="alert">
  						<strong>There was error in your form:</strong> Invalid email. Enter valid email address so I can get back to you.
							</div>'; 
			}
		$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
		$password = sha1($password);
		
	try {		
		$link = connectDB();
				
		$query = "show tables like '".$username."'";
		if($result = mysqli_query($link,$query)) {
			
				if(mysqli_num_rows($result) == 1) {
					echo "You are already registered. Log in instead.";
		  		} else {
					$query = "create table ".$username."(dataID int(10) not null auto_increment primary key,first_name varchar(20) not null,last_name varchar(20) not null,phone_number bigint not null,email varchar(50) null);";
					$sql = "insert into `users`(`username`,`email`,`password`) values('".$username."','".$email."','".$password."')";
					if(mysqli_query($link,$query) && mysqli_query($link,$sql)) {
						$_SESSION['username'] = $username;
						header("Location: loggedIn.php");
						
					} else {
						echo "<br>Error: ".$sql."<br>".mysqli_error($link);
						echo "<br>Error: ".$query."<br>".mysqli_error($link);
					}
				}
		}
	} catch (Exception $e) { echo "Unable to process request"; }
	}
}

mysqli_close($link);
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" 
    integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
	 integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">-->
	 <title>Online Phonebook</title>
	 <style type="text/css">
	 * {font-size: 18px !important;}  /*  <--- TAKE THIS OFF !  */
	 	body {font-family: 'Dancing Script', cursive;background-image: url("phone.jpg");background-position: right;background-repeat: no-repeat;
	 	background-size: cover;}
	 	#border {margin-left:10px;border 1px solid white;border-radius: 8px;}
	 	h1 , h2 , p {padding: 10px;}
	 	h1 {font-size: 60px;}
	 	h2 {font-size: 50px;}
	 	#fromLeft {margin-left: 120px;}
	 	h2 , h3 {margin-left: 100px;}
	 	h3 {font-size: 40px;}
	 	/*.jumbotron {background-color: transparent;text-align: left;}*/
	 	form {width: 300px;}
	 	label {font-size: 40px;}
	 	input {margin-bottom: 10px;}
	 	#submit {margin-top: 10px;font-size: 30px;}
	 	#login {display:none;margin-left: 30px;margin-top: 60px;}
	 	#signup {margin-left: 30px;margin-top: 60px;}
	 </style>
    
  </head>
  <body>
  	<!--<div id="border">
				<h1>Save your friend's or <span style="color:white;">family</span><br> member's phone number.</h1>
				<h2>First timer ?</h2><?php echo $success; ?><h1 id="fromLeft">Sign Up !</h1>
				<h3>or log in to add new numbers</h3>
				</div>-->
    
    <div class="container" style="width:300px;">
    
    	<form method="post" action="phonebookMainPage.php" id="login" style="margin-bottom:40px;">
			<div class="form-group">
			<label>Username: </label><input class="form-control" type="text" name="usernameToCheck" required>
			<label>Password: </label><input class="form-control" type="password" name="passwordToCheck" required>
			<input type="submit" name="submit" value="Log In" class="form-control">
		</form>
   
		<form method="post" action="phonebookMainPage.php" id="signup">
			<div class="form-group">
				
				<label>Choose Your Username</label>
				<input type="text" class="form-control" name="username" alt="username" autofocus="autofocus" required>
				<label>Your Email</label>
				<input type="email" class="form-control" name="email" alt="email" required>
				<label>Password</label>
				<input type="password" class="form-control" name="password" alt="password" placeholder="password" required>
				<input type="submit" name="submit" class="btn btn-primary" id="submit" value="Register">		
			</div>	
		</form> 
	
	</div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>