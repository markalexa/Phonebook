<?php
	session_start();
	include('sqlfunction.php');
	
	if($_SESSION['username']) {
		$message = "";
		$username = $_SESSION['username'];
	
	
	$link = connectDB();
	$query = "select dataID,first_name,last_name,phone_number,email from ".$username;
	$numberOfEntries = "SELECT count(*) as total from ".$username.";";
	$res = mysqli_query($link,$numberOfEntries);
	$numberOfEntries_RESULT = mysqli_fetch_assoc($res);
	if($numberOfEntries_RESULT['total'] < 1) {
			$message = '<li style="color:yellow;font-weight:bold;font-family:Arial;font-size:20px;">
			<img src="arrow.png" width="20" height="auto" class="animated infinite bounce">&nbsp;&nbsp;&nbsp;Your phonebook is plain empty. Let\'s start with
			 adding a person</li>';
		}		
				
	if($result = mysqli_query($link,$query)) {
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
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css"
  		integrity="sha384-OHBBOqpYHNsIqQy8hL1U+8OXf9hH6QRxi0+EODezv82DfnZoV7qoHAZDwMwEJvSw"
  		crossorigin="anonymous">
  	<link rel="stylesheet" type="text/css" href="phonebook.css">
	 <title>Online Phonebook: Your Phonebook</title>
   
  </head>
  <body>
  <div class="page-header">
  <ul><li><h1 style="margin-right:40px;color:white;">Online PhoneBook</h1></li><li><a class="orange" href="loggedOut.php">Log Out</a></li>
  <li><a class="orange" href="addPerson.php" style="margin-left:10px;">Add Person</a></li>$message</ul>
  </div>
  	<h3>Howdy, $username</h3>
  <div class="jumbotron">
   	<div class="container">
  
END;
			
echo <<<END
				<table>
				<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th><th>Action</th></tr>
END;
			while($row = mysqli_fetch_array($result)) {
								
				echo	"<tr><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td><td><form action='updatePhonebook.php' method='post'>
				<input type='hidden' name='q' value='".$row[0]."'><input type='submit' value='Update'></form><form action='loggedIn.php' method='post'>
				<input type='hidden' name='q' value='".$row[0]."'><input  type='submit' name='delete' value='Delete'></form></td></tr>";
					
			}
			echo "</table><small>Notice: Phone numbers are displayed excluding initial zero."; 
  		} else {
  			echo "<br>Error: ".$query."<br>".mysqli_error($link);
  		}
		if(isset($_POST['delete'])) {
			$rowToDelete = $_POST['q'];
			$sql = "delete from ".$username." where dataID=".$rowToDelete.";";
			if($result = mysqli_query($link,$sql)) {
				header("Location: loggedIn.php");
			} else {
				echo "<br>Error: ".$sql."<br>".mysqli_error($link);
			}
	}
} else {
		header("Location: phonebookMainPage.php");
}
echo <<<END
	</div>
	</div>
	<a style="text-align:right;position:absolute;right:2px;bottom:18px;" alt="throw phonebook away" id="deleteAccount"><img  width="50%" length="auto" src="trashcan.png"></a>
	<p id="credit">Photo by Álvaro Serrano on Unsplash</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script language="javascript">
    $("#deleteAccount").on("click", function() {
    	if(confirm("Are you sure ?  If you click OK all data will be erased and account deleted. This is irreversible.") ==true) {
    		location.href='accountDeleted.php';
    	} else {

    	}
    });
    </script>
	 </body>
</html>
END;
mysqli_close($link);
?>