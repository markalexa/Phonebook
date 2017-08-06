<?php 
session_start();
include('sqlfunction.php');

if(isset($_SESSION['username'])) {
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
} else {

	header("Location: phonebookMainPage.php");
}
?>