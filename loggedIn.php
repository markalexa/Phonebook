<?php
	session_start();
	include('sqlfunction.php');
	
	if($_SESSION['username']) {
		
		$username = $_SESSION['username'];
	
	
	$link = connectDB();
	$query = "select dataID,first_name,last_name,phone_number,email from ".$username;
	$numberOfEntries = "SELECT count(*) as total from ".$username.";";
	$res = mysqli_query($link,$numberOfEntries);
	$numberOfEntries_RESULT = mysqli_fetch_assoc($res);
				
				
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
	 <title>Online Phonebook: Your Phonebook</title>
    <style>
    
    table, th, td {border: 1px solid black; border-collapse: collapse;padding:10px;text-align:center; }
	table th { background-color: black; color: white; padding-left:15px;padding-right:15px; }    
	table tr:nth-child(even) { background-color: #eee; }
	table tr:nth-child(odd)  { background-color: #fff; }
	form {display:inline;padding:5px;}
	.page-header {margin:0;font-family:'Dancing Script',Arial;font-size:25px;}
	.page-header ul li {display:inline-block;padding-right:10px;}
	</style>
  </head>
  <body>
  <div class="page-header">
  <ul><li><h1>Online PhoneBook</h1></li><li><a href="logout.php">Log out</a></li><li><a href="addPerson.php" style="margin-left:10px;">Add Person</a></li></ul>
  </div>
  	<h3>Howdy, $username</h3>
  <div class="jumbotron">
   	<div class="container">
  
END;
	
		if($numberOfEntries_RESULT['total'] < 1) {
			echo "Your phonebook is plain empty. Let's start with adding person.";
		}
			
		echo <<<END
				<table>
				<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th><th>Action</th></tr>
END;
			while($row = mysqli_fetch_array($result)) {
								
				echo	"<tr><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td><td><form action='updatePhonebook.php' method='post'>
				<input type='hidden' name='q' value='".$row[0]."'><input type='submit' value='Update'></form><form action='loggedIn.php' method='post'>
				<input type='hidden' name='q' value='".$row[0]."'><input  type='submit' name='delete' value='Delete'></form></td></tr>";
					
			}
			echo "</table>"; 
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
END;
mysqli_close($link);
?>