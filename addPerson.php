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

<html>
<head></head>
<body>

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



</body>
</html>