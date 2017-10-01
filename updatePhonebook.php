<?php
	session_start();
	require('sqlfunction.php');

  if(isset($_SESSION['username'])) {

	$username = $_SESSION['username'];
	$dataID = $_SESSION['dataID'];
	$link = connectDB();
	$q = $_POST['q'];
	$query = "select dataID,first_name,last_name,phone_number,email from ".$username." where dataID=".$q;	

   if($stmt = $link->prepare($query)) {
   	$stmt->execute();
   	$stmt->bind_result($dataID,$firstName,$lastName,$phoneNumber,$email);
   	
   	
   	while($stmt->fetch()) {
   		echo <<<END
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
   <link rel="stylesheet" type="text/css" href="phonebook.css">
	 <title>Online PhoneBook: Update</title>
	 <style type="text/css">
	 	.page-header {margin:0;}
	 	table th {text-align:center;padding:3px 5px;}
	 </style>
  </head>
  <body>
  
  <nav class="navbar">
	  <div class="container-fluid">
		  <div class="navbar-header">
		    <ul>
				  <li><h1 style="color:black;margin-right:10px;">Online PhoneBook</h1></li><li><a class="orange" href="loggedOut.php">Log Out</a></li>
				  <li><a class="orange" href="addPerson.php" style="margin-left:10px;">Add Person</a></li>
				  <li><a id="back" href="loggedIn.php">Back</a></li>
			 </ul>
		  </div> 
	  </div> 
  </nav>
  
  <div class="jumbotron">
  <div class="container">
   		<form action="updatePhonebook.php" method="post">
   		<table><tr><th></th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th></tr>  		
   		<tr><td><input type="hidden" name="q" value="$dataID"></td><td><input type="text" name="firstName" value="$firstName" required></td><td><input type="text" name="lastName" value="$lastName" required></td>
			<td><input type="number" name="phoneNumber" value="$phoneNumber" required></td><td><input type="email" name="email" value="$email" placeholder="optional"></td><td><input type="submit" name="update" value="Update"></td></tr></table>
			</form>
	</div>
	</div>
	 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
END;
			
  		 }
  		   		 
  		 if(isset($_POST['update'])) {
  		
  			$dataID = $_POST['q'];
  			$firstName = filter_var($_POST['firstName'],FILTER_SANITIZE_STRING);
  			$lastName = filter_var($_POST['lastName'],FILTER_SANITIZE_STRING);
  			$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
  			$phoneNumber = $_POST['phoneNumber'];
		  	
		  	$query = "update ".$username." set first_name='".mysqli_real_escape_string($link,$firstName)."',last_name='".mysqli_real_escape_string($link,$lastName)."',
		  	phone_number='".$phoneNumber."',email='".mysqli_real_escape_string($link,$email)."' where dataID=".$dataID.";";
		  	
		  	if($result = mysqli_query($link,$query)) {
		  		
				header("Location: loggedIn.php");		  	
		  	} else {
		  		echo "<br>Error: ".$query."<br>".mysqli_error($link);
		  	}
  		}	
} else {
	echo "Unable to connect.";
	exit();
}

 mysqli_close($link);
} else {
  header("Location: phonebookMainPage.php");
}
?>