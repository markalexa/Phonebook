<?php
    
    include('config.php');
    
    function connectDB() {
        
        $link = new mysqli(db_host,db_user,db_name,db_pwd);
            if($link->connect_error) {
            die("Connection failed: ".$link->connect_error);
            }
        
            return $link;
        
    }
    

  
        
        /*This function is to check if the IP identified is in the correct format and not in a non-routable range.*/
function f_validIP($ip) {
       /*!empty($ip) checks if $ip is populated*/
       /*ip2long($ip) is a form of validation on the input*/
  if (!empty($ip) && ip2long($ip)!=-1) {
               /*Create an array of arrays standard non routable IPs so we can filter 
               out IPs that aren’t useful*/
    $reserved_ips = array (
      array('0.0.0.0','2.255.255.255'),
      array('10.0.0.0','10.255.255.255'),
                 array('127.0.0.0','127.255.255.255'),
                 array('169.254.0.0','169.254.255.255'),
                 array('172.16.0.0','172.31.255.255'),
                 array('192.0.2.0','192.0.2.255'),
                 array('192.168.0.0','192.168.255.255'),
                 array('255.255.255.0','255.255.255.255')
    );
               /*Compare the IP to each array and return a false if the IP is within any 
               of the ranges*/
    foreach ($reserved_ips as $r) {
      $min = ip2long($r[0]);
      $max = ip2long($r[1]);
      if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
    }
               /*if the ip is populated and isn’t in the non routable range, return true*/
    return true; 
  } else {
      return false;     
  }
}

function f_getIP() {
    
     if (f_validIP($_SERVER["HTTP_CLIENT_IP"])) {
    return $_SERVER["HTTP_CLIENT_IP"];
  }
  foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
    if (f_validIP(trim($ip))) {
      return $ip;
      }
    }
  if (f_validIP($SERVER["HTTP_X_FORWARDED"])) {
    return $_SERVER["HTTP_X_FORWARDED"];
  } elseif (f_validIP($_SERVER["HTTP_FORWARDED_FOR"])) {
    return $_SERVER["HTTP_FORWARDED_FOR"];
  } elseif (f_validIP($_SERVER["HTTP_FORWARDED"])) {
    return $_SERVER["HTTP_FORWARDED"];
  } elseif (f_validIP($_SERVER["HTTP_X_FORWARDED"])) {
    return $_SERVER["HTTP_X_FORWARDED"];
  } else {
    return $_SERVER["REMOTE_ADDR"];
  }
}

function f_tableExists(mysqli $link,$tablename,$database = false) {
    if(!$database) {
        $res = mysqli_query($link,"select_database()");
        $database = mysql_result($res,0);
    }
    $res = mysqli_query($link, "select count(*) as count from information_schema.tables where table_schema = '$database' and table_name = '$tablename'");
    echo '<br>Table Exists: '.($res->num_rows);
    return $res->num_rows == 1;
}

?>
