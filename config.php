<?php
$host = 'localhost'; 
$dbUser = 'root'; 
$dbPass = ""; 
$dbName = 'lazur'; 
 
if(!$dbConn = mysqli_connect($host, $dbUser, $dbPass)) {
    die('Не може да се осъществи връзка със сървъра.');
}
echo "Връзката е успешна. <br>";

if (!mysqli_select_db($dbConn, $dbName)){
    die('Не може да се селектира базата от данни.');
}

echo "Базата данни е селектирана. <br>";

?>