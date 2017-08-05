<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require('sqlfunction.php');
	$link = connectDB();
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
	 <title>Bootstrap 101 Template</title>
    <style type="text/css">
    	table {margin-left: 20px;margin-top: 30px;}
    	table, th, td {border: 1px solid black;border-collapse: collapse; text-align: center;padding-left: 10px;padding-right: 10px;}
	 	table th {background-color: black;color: white;}
	 	table tr {text-align: center;}
	 	table tr:nth-child(even) {background-color: #eee;}
	 	table tr:nth-child(odd) {background-color: #fff;}
    </style>
  </head>
  <body>
    <h1>Here's your phonebook</h1>
    <a href="createEntry.php">Add Person</a>
    <?php
    		
  			$query = "select first_name,last_name,phone_number,email from userData";
  			echo '<br>query :'.$query.'<br>Delete this after testing.<br>';
  			if($result = mysqli_query($link,$query)) {
								
				echo "<table><tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Email</th></tr>";
				
			while($row = mysqli_fetch_array($result)) {
				
				echo	"<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td></tr>";
					
			}
			echo "</table>"; 
  		}	
  				
	mysqli_close($link);
	?>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>