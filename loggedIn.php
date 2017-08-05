<?php
	session_start();
	include('sqlfunction.php');
	
	if($_SESSION['username']) {
		
		echo $_SESSION['username'];
		$username = $_SESSION['username'];
	
	
	$link = connectDB();
	$query = "select dataID,first_name,last_name,phone_number,email from ".$username;
	$numberOfEntries = "SELECT count(*) as total from ".$username.";";
	$res = mysqli_query($link,$numberOfEntries);
	$numberOfEntries_RESULT = mysqli_fetch_assoc($res);
				
				
	if($result = mysqli_query($link,$query)) {
		if($numberOfEntries_RESULT['total'] < 1) {
			echo "Your phonebook is plain empty. Let's start with adding person.";
		}
			
		echo "<table><tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th><th>Update / Delete</th></tr>";
				
			while($row = mysqli_fetch_array($result)) {
								
				echo	"<tr><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td><td style='display:in-line;'><form action='updatePhonebook.php' method='post'>
				<input type='hidden' name='q' value='".$row[0]."'><input type='submit' value='Update'></form><form action='loggedIn.php' method='post'>
				<input type='hidden' name='q' value='".$row[0]."'><input type='submit' name='delete' value='Delete'></form></td></tr>";
					
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
mysqli_close($link);
?>
<a href="logout.php">Log out</a><a href="addPerson.php" style="margin-left:10px;">Add Person</a>