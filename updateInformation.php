<?php

	require('sqlfunction.php');
	
	if(!empty($_POST)) {
	
		$firstName = filter_var($_POST['first_name'],FILTER_SANITIZE_STRING);
		$lastName = filter_var($_POST['last_name'],FILTER_SANITIZE_STRING);
		$phoneNumber = $_POST['phone_number'];
		$email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
		
		$link = connectDB();
		$query = "update userData set first_name='".$firstName."',last_name='".$lastName."',phone_number='".$phoneNumber."',email='".$email."' where dataID=".$q;
		echo $query."<br>This will be deleted after testing.<br>";
		if(mysqli_query($link,$query)) {
			echo "<br>Update successful !";
		} else {
			echo "<br>Error: ".$query."<br>".mysqli_error($link);
		}
		mysqli_close($link);
	}
?>
