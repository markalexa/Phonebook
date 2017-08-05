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
		
		$sql = "insert into ".$username."(`first_name`,`last_name`,`phone_number`,`email`) values('".$firstName."','".$lastName."','".$phoneNumber."','".$email."')";
		if($result = mysqli_query($link,$sql)) {
			header("Location: loggedIn.php");
		} else {
			echo "<br>Error: ".$sql."<br>".mysqli_error($link);
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
	 <title>Online PhoneBook: Adding Person</title>
	 <link rel="stylesheet" type="text/css" href="phonebook.css">
  </head>
  <body>
  <div class="page-header">
  <ul><li><h1 style="margin-right:40px;"><span>Onl</span>ine PhoneBook</h1></li><li><a class="orange" href="logout.php">Log out</a></li><li><a class="orange" href="addPerson.php" style="margin-left:10px;">Add Person</a></li></ul>
  </div>

<div class="container">
    <h1>Add Person</h1>
    <form action="addPerson.php" method="post" onsubmit="return validateForm()">
    	<div class="form-control">
			<p>First Name: <input type="text" name="first_name" maxlength="20" required></p>
			<p>Last Name: <input type="text" name="last_name" maxlength="20" required></p>
			<p>Phone Number: <input type="number" name="phone_number" maxlength="10" required></p>
			<p>Email: <input type="email" name="email"></p>
			<input type="submit" name="submit">
    	</div>
    </form>
    </div>


	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>