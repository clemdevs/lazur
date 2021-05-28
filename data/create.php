<?php 

require_once "config.php";

$errors = [];

// sql to create table
$table1 = "CREATE TABLE `provider` (
`id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
`deliver` VARCHAR(30) NOT NULL,
`bulsat`  VARCHAR(11) NOT NULL,
`address` INT(6) UNSIGNED,
`telephone` VARCHAR(10) NOT NULL,
`year` YEAR NOT NULL,
`person` VARCHAR(30) NOT NULL UNIQUE,
PRIMARY KEY(`id`),
INDEX indx_address (`address`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$table2 = "CREATE TABLE `cities` (
`id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
`city` VARCHAR(30) NOT NULL,
`cityId` INT(6) UNSIGNED,
PRIMARY KEY(`id`),
CONSTRAINT `fk_address_city`
FOREIGN KEY(`cityId`) REFERENCES `provider`(`address`)
    ON UPDATE CASCADE ON DELETE CASCADE
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$tables = [$table1, $table2];


foreach($tables as $c => $sql){
  $query = $dbConn->query($sql);



  if(!$query)
     $errors[] = "Table $c : Creation failed ($dbConn->error)";

  else
     $errors[] = "Table $c : Creation done\n";
}


foreach($errors as $msg) {
 echo "$msg <br>";
}

$dbConn->close();