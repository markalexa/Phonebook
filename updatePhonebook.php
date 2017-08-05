<?php
	session_start();
	//include('session.php');
	require('sqlfunction.php');
	$username = $_SESSION['username'];
	$dataID = $_SESSION['dataID'];
	$link = connectDB();
	$q = $_POST['q'];
	$query = "select dataID,first_name,last_name,phone_number,email from ".$username." where dataID=".$q;
	
	
	echo '<br>Query: '.$query.'<br>This will be deleted after testing.<br>';
   if($stmt = $link->prepare($query)) {
   	$stmt->execute();
   	$stmt->bind_result($dataID,$firstName,$lastName,$phoneNumber,$email);
   	echo '<a href="loggedIn.php">Back</a>';
   	echo "<table><tr><th></th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th></tr>";
   	while($stmt->fetch()) {
   		echo <<<END
   		<body>
   		<form action="updatePhonebook.php" method="post">   		
   		<tr><td><input type="hidden" name="q" value="$dataID"></td><td><input type="text" name="firstName" value="$firstName" required></td><td><input type="text" name="lastName" value="$lastName" required></td>
			<td><input type="number" name="phoneNumber" value="$phoneNumber" required></td><td><input type="email" name="email" value="$email"></td></tr></table><input type="submit" name="update" value="Update">
			
			
END;
			
  		 }
  		 echo '</form></body>';
  		 
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
?>