<?php
	include('phpForMainPage.php');	
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
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	<title>Online Phonebook</title>
	<link rel="stylesheet" type="text/css" href="phonebookMainPageStylesheet.css">
    
  </head>
  <body>
  <a id="switch">Log In</a>
  <?php echo $message; ?>
  	
    
  <div class="jumbotron">
    	<div class="col-md-3">
    
    	<form method="post" action="phonebookMainPage.php" id="login">
			<div class="form-group">
			<label>Username: </label><input class="form-control" autofocus="autofocus" type="text" name="usernameToCheck" required>
			<label>Password: </label><input class="form-control" type="password" name="passwordToCheck" required>
			<input id="loginBtn" type="submit" name="submit" value="Log In">
			
			</div>
		</form>
   
		<form method="post" action="phonebookMainPage.php" id="signup">
		<?php echo $errMsg; ?>
			<div class="form-group">
				
				<label>Choose Your Username</label>
				<input type="text" class="form-control" name="username" alt="username" required>
				<label>Your Email</label>
				<input type="email" class="form-control" name="email" alt="email" required>
				<label>Password</label>
				<input type="password" class="form-control" name="password" alt="password" required>
				<input type="submit" name="submit" class="btn btn-primary" id="submit" value="Register">		
			</div>	
			 
		</form> 
	</div>
	<div class="col-md-9" id="text">
		
				<h1>Save your phone numbers into<br> The Online Phonebook.</h1>
				<h1>Securely. For free. Period.</h1>	
				<h2>First timer ?</h2><h1 id="fromLeft">Sign Up !</h1>
				<h3 style="margin-left: 200px;">or log in to add new numbers</h3>
		
	</div>
	

    <p id="credit">Photo by Aaron Burden on Unsplash</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">
    	$("#switch").on('click',function () {
    		$("#switch").html(($("#switch").html() == 'Log In') ? 'Back to Sign Up' : 'Log In');
    		$("#signup").toggle();
    		$("#login").toggle();
    		$("#text").toggle();
    	});
    </script>
  </body>
</html>