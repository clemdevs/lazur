<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lazur";

// Create connection
try{
   $dbConn = new mysqli($servername, $username, $password, $dbname);
   
}catch(\mysqli_sql_exception $e){
   throw new \mysqli_sql_exception($e->getMessage(), $e->getCode());
}finally{
   unset($servername, $username, $password, $dbname);
}

?>

