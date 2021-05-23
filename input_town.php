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
    <link rel="stylesheet" href="style.css">
    <title>Град</title>
</head>
<body>
    <form action="input_town.php" method="post">
        <pre>
            Град: <input type="text" name="city" />
            <input type="submit" name="submit" value="Въведи"/>
        </pre>
    </form>
</body>
</html>

<?php


if (isset($_POST["submit"])){
    
    $city = htmlentities($_POST['city']);
    
    if(!empty($city)){
        
    $records[] = insertCity($dbConn, $city);

    } else {
        die("Не сте въвели запис");
    }
} 
?>

<table>
    <tr>
    <th>Номер</th>
    <th>Град</th>
    <?php
    $results = getCities($dbConn);


    if(count($results) > 0):

        foreach($results as $res):
            ?>
            </tr>
            <tr>
            <td><?php echo $res["id"]; ?></td>
            <td><?php echo $res["city"]; ?></td>
            </tr>
            <?php
        endforeach;

    else:
        ?>
        <tr>
        <td colspan="2">Няма въведени записи</td>
        </tr>
        <?php
    endif;

    ?>

</tr>
</table>