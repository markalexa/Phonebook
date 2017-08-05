<?php
	session_start();
	include('sqlfunction.php');
	
	if($_SESSION['username']) {
		echo $_COOKIE["userID"];
		echo $_SESSION['username'];
		$username = $_SESSION['username'];
	
	
	$link = connectDB();
	$query = "select first_name,last_name,phone_number,email from ".$username;
	if($result = mysqli_query($link,$query)) {
		
		echo "<table><tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th></tr>";
				
			while($row = mysqli_fetch_array($result)) {
				if(mysqli_num_rows($result) == 0) {
					echo "Your phonebook is empty. Let's start with adding person.";
				}
				
				echo	"<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td></tr>";
					
			}
			echo "</table>"; 
  		} else {
  			echo "<br>Error: ".$query."<br>".mysqli_error($link);
  		}
		
	if(isset($_POST['submit'])) {
		$link = connectDB();
		
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$phoneNumber = $_POST['phone_number'];
		$email = $_POST['email'];
		
		$sql = "insert into ".$username."(`first_name`,`last_name`,`phone_number`,`email`) values('".$firstName."','".$lastName."','".$phoneNumber."','".$email."')";
		if($result = mysqli_query($link,$sql)) {
			echo "Details saved !";
		} else {
			echo "<br>Error: ".$sql."<br>".mysqli_error($link);
		}	
	}
} else {
		header("Location: phonebookMainPage.php");
}
mysqli_close($link);
?>
<html>
<head></head>
<body>
<a href="logout.php">Log out</a>
<div class="container">
    <h1>New entry</h1>
    <form action="phonebook.php" method="post" onsubmit="return validateForm()">
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