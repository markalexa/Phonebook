<?php
	session_start();
	include('sqlfunction.php');
	$username = $_SESSION['username'];

	if(isset($_POST['submit'])) {
		$link = connectDB();
		
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$phoneNumber = $_POST['phone_number'];
		$email = $_POST['email'];

		$query = "select phone_number from ".$username." where phone_number=".$phoneNumber.";";
		
		if($result = mysqli_query($link,$query)) {
				if(mysqli_num_rows($result) == 1) {
					$message = '<div style="width150px;font-family:Arial;font-size:18px;" class="alert alert-warning" role="alert">
  					<strong>O-Ohh ...</strong> You already have this number in your phonebook. Perhaps just update it ?<div>';
				
			
				} else {
		
		$sql = "insert into ".$username."(`first_name`,`last_name`,`phone_number`,`email`) values('".$firstName."','".$lastName."','".$phoneNumber."','".$email."')";
		if($result = mysqli_query($link,$sql)) {
			header("Location: loggedIn.php");
		} else {
			echo "<br>Error: ".$sql."<br>".mysqli_error($link);
		}
	}	
	mysqli_close($link);
}	
}
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
	 <link rel="stylesheet" type="text/css" href="phonebook.css">
	 <title>Online PhoneBook: Adding Person</title>
	 <style type="text/css">
	 	html {overflow-y: hidden;}
	 	.page-header h1 {color:white;}
	 	body {font-family: 'Dancing Script',Arial;font-size:25px;}
	 	.jumbotron {padding-top: 0;margin-left: 10px;}
	 	h2 {margin-left: 70px;}
	 	button {margin-top: 5px;width: 210px;}
	 	input {font-family: Arial;font-size: 18px;}
	 </style>
  </head>
  <body>
  <div class="page-header">
  <ul><li><h1 style="margin-right:40px;"><span>Onl</span>ine PhoneBook</h1></li><li><a class="orange" href="logout.php">Log out</a></li><li>
  <a class="orange" href="addPerson.php" style="margin-left:10px;">Add Person</a></li><li><a href="loggedIn.php">Back</a></li></ul>
  </div>

<div class="jumbotron">
<h2>Add Person</h2>
	<div class="container">
    
    <div class="col-md-4">
    <form action="addPerson.php" method="post" onsubmit="return validateForm()">
    
    	<div class="group-control">
			<label>First Name: <input type="text" class="form-control" name="first_name" maxlength="20" required></label><br>
			<label>Last Name: <input type="text" class="form-control" name="last_name" maxlength="20" required></label><br>
			<label>Phone Number: <input type="number" class="form-control" name="phone_number" maxlength="10" required></label><br>
			<label>Email: <input type="email" class="form-control" name="email"></label><br>
			<button type="submit" class="btn btn-primary" name="submit">Add</button>
    	</div>
    </form>
    </div>
    <div class="col-md-4"><?php echo $message; ?></div>
    <div class="col-md-4"></div>
    </div>
    </div>


	<p id="credit">Photo by Álvaro Serrano on Unsplash</p>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>