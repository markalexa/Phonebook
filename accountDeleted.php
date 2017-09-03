<?php
  session_start();
  include('sqlfunction.php');
  
  $message = "";

  if(isset($_SESSION['username'])) {

  $username = $_SESSION['username'];
  $link = connectDB();
  $query = "drop table ".$username.";";
  $sql = "delete from `users` where username='".$username."';";
 
  $userDeleted = mysqli_query($link,$query);
  $tableDeleted = mysqli_query($link,$sql);
  if ($userDeleted && $tableDeleted) {
        $message = "<h1>Your phonebook is now in the bin. Sorry that you're leaving,
     but remember, your<br> Online Phonebook is just a click away. :)</h1>";
    } else {
        $message = "Something went wrong";
    }


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
	 <title>Online Phonebook: Phonebook deleted</title>
   <style type="text/css">
   html {height: 100%;}
   body {font-family: 'Dancing Script',Arial;background-image: url("bin.jpg");background-size: cover;background-position: center center;background-repeat: no-repeat;}
   .container {background: transparent !important;margin-top:50px;}
   #credit {font-family: Arial;font-size: 12px;position: absolute;bottom: 0;right: 0;margin:0;padding: 0;}
   </style> 
  </head>
  <body>
  <div class="container">
    $message
  </div>
    <p id="credit">Photo by Shane Rounce on Unsplash</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
END;

} else {
  header("Location: phonebookMainPage.php");
  
}
mysqli_close($link);
session_unset();
session_destroy();
?>