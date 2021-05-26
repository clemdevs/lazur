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
PRIMARY KEY(`id`, `address`),
INDEX(`address`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

$table2 = "CREATE TABLE `cities` (
`id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
`cityId` INT(6) UNSIGNED,
`city` VARCHAR(30) NOT NULL,
PRIMARY KEY(`id`),
CONSTRAINT `fk_address_city`
FOREIGN KEY (`cityId`) 
REFERENCES `provider`(`address`)
ON UPDATE CASCADE 
ON DELETE CASCADE
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

//example data

/*
* Абоба 00006587412 2 0881111111 1995 Ева Илиева
* Иванови 0007845789 2 0894222222 2015 Петър Иванов
* Кокиче 0000877412 5 0881111115 2007 Милена Георгиева
* Лазур 00000856231 1 0888888888 2001 Мария Руменова
* Маг 045891245 4 094611111 1996 Иво Николов
* Орхидея 005417863 4 0885666666 2010 Митко Тодоров
*/
