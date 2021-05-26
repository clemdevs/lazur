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
    <title>Provider</title>
</head>
<body>
    <form action="input_provider.php" method="post">
    <pre>
    Фирма: <input type="text" name="dlvr">
    Булстат: <input type="text" name="blst">
    Населено място: 
    <select name="addr">
    <option disabled selected>---ИЗБЕРИ---</option>
    <?php
        $dropdown_res = getCities($dbConn);
        foreach($dropdown_res as $option){
            echo "<option>" . $option["city"] . "</option>";
        }
    ?>
    </select>

    Телефон: <input type="text" name="phone">
    Година на регистрация: <input type="text" name="yr">
    Лице за контакти: <input type="text" name="person">
    <input type="submit" name="submit" value="Добави" />
    </pre>
    </form>

    <?php if(isset($_POST["submit"]))
    {
        $dl = isset($_POST['dlvr']) ? htmlentities($dbConn->real_escape_string($_POST['dlvr'])) : null;
        $bt = isset($_POST['blst']) ? htmlentities($dbConn->real_escape_string($_POST['blst'])) : null;
        $tel = isset($_POST['phone']) ? htmlentities($dbConn->real_escape_string($_POST['phone'])) : null;
        $adr = isset($_POST['adr']) ? htmlentities($dbConn->real_escape_string($_POST['adr'])) : null;
        $yr = isset($_POST['yr']) ? htmlentities($dbConn->real_escape_string($_POST['yr'])) : null;
        $psn = isset($_POST['person']) ? htmlentities($dbConn->real_escape_string($_POST['person'])) : null;

        if(!empty($dl) || !empty($bt) || !empty($adr) || !empty($tel) || !empty($yr) || !empty($psn))
        {
            $citiesInfo = getCities($dbConn);

        foreach($citiesInfo as $cti){
                if(isset($_POST["addr"])){
                    if($_POST["addr"] == $cti["city"]){
                        $ids = htmlentities($dbConn->real_escape_string($cti["id"]));
                        $provider_data = setProvider($dbConn, $dl, $bt, $ids, $tel, $yr, $psn);
                        setCityProvider($dbConn, $ids, $ids);
                    }
                }
            }
        } 
    } 

    ?>

    <table cellspacing="6">
    <tr>
        <th>Доставчик</th>
        <th>Булстат</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th>Година на регистрация</th>
        <th>Лице за контакти</th>
        </tr>
        
        <?php 
            $getProvider = getProviders($dbConn);
            
            if(count($getProvider) > 0):

            foreach ($getProvider as $provider):

            ?>
            <tr>
                <td><?php echo $provider->deliver; ?></td>
                <td><?php echo $provider->bulsat; ?></td>
                <td><?php echo $provider->address; ?></td>
                <td><?php echo $provider->telephone; ?></td>
                <td><?php echo $provider->year; ?></td>
                <td><?php echo $provider->person; ?></td>
            </tr>
            <?php endforeach; 
                else:
            ?>
            <tr>
            <td colspan="6">Няма въведени записи</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>