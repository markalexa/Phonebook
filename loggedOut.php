<?php 
  session_start();
  $_SESSION = array();
  
  session_unset();
  session_destroy();
    
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
   <link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	 <title>Online Phonebook: Logged Out</title>
   <style type="text/css">
   html {height: 100%;}
   body {background-image: url("bgLoggedOut.jpg");background-repeat: no-repeat;background-position: center center;background-size:  cover;font-family: 'Dancing Script',Arial;color: white;}
   a, a:hover {text-decoration: none;}
   a {font-size: 20px;position: absolute;top: 3px;right: 3px;}
   h1 {margin-left: 100px;}
   p {position: absolute;bottom: 0;right: 0;font-family: Arial;font-size: 12px;margin: 0;padding:0;}
   .jumbotron {background: transparent !important;}
   </style>
  </head>
  <body>
  <a href="phonebookMainPage.php" alt="back to the main page"><h4>Back to the main page</h4></a>
   <div class="jumbotron">
   <h1>You're now logged out. Have a good one !<h1>
   </div>

   
   <p>Photo by Priscilla Du Preez on Unsplash</p>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>