<?php 
require_once "config.php"; 
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

getOneProviderUpdate($dbConn);

?>
</body>
</html>
