<?php

session_start();
	setcookie("userID","1234",time() + 3600 * 24 * 7);
	require('sqlfunction.php');
	$message = $errMsg = "";
	
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
				
				$message = '<div style="font-family:Arial;font-size:18px;margin-left:8px;margin-top:10px;width:250px;" class="alert alert-danger" role="alert" id="error">
  							<p><strong>Login failed.</strong></p>Double-check your logins.</div>';
			}
		} catch (Exception $e) { echo "Request couldn't be processed"; }
		mysqli_close($link);
			

	
	} else if($_POST['submit'] == "Register") {
		
		$username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  					$errMsg = '<div class="alert alert-danger" role="alert">
  						<strong>There was error in your form:</strong> Invalid email.</div>'; 
			}
		$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
		$password = sha1($password);
		
	try {		
		$link = connectDB();
				
		$query = "show tables like '".$username."'";
		if($result = mysqli_query($link,$query)) {
			
				if(mysqli_num_rows($result) == 1) {
					$errMsg = '<div style="font-family:Arial;font-size:18px;" class="alert alert-danger" role="alert" id="error">
  							<p><strong>Hey !</strong></p>You\'re already registered. Log in instead</div>';
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

?>