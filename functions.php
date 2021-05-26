<?php

require_once "config.php";

function insertCity(mysqli $dbConn, $data){
    try{
        $record = [];

        $sql = "INSERT INTO `cities` (`city`) VALUES (?)";   
    
        $stmt = $dbConn->prepare($sql); 

        $stmt->bind_param('s', $data); 

        $stmt->execute(); 

        $stmt->get_result(); 

        $rows = $stmt->affected_rows;

        if($rows){
            printf("Въведени записи: %d", $rows); 
        } else {
            die("Грешка при въвеждане на данни:\n". $dbConn->error . "\n" 
                                                . $dbConn->errno . "\n");
        }
        
        $stmt->close();
        return $record;
    }
    catch (\mysqli_sql_exception $e){
        $dbConn->close();
        die($e->getMessage);
    }
} 


function setProvider(mysqli $dbConn, $d, $b, $a, $t, $y, $p){
    try{
        $record = [];
        

        $sql = "INSERT INTO `provider` (`deliver`, `bulsat`, `address`, `telephone`, `year`, `person`) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $dbConn->prepare($sql);

        $stmt->bind_param('ssisss', $d, $b, $a, $t, $y, $p);
        
        $stmt->execute(); 

        $result = $stmt->get_result(); 


        $result = $stmt->affected_rows;

        if($result){
            printf("Въведени записи: %d", $result); 
        } else {
            die(throw new \mysqli_sql_exception("Грешка при въвеждане на данни:\n". $dbConn->error . "\n" 
                                                                                  . $dbConn->errno . "\n"));
        }

        $stmt->close();
        return $record;
    } catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die($e->getMessage());
    }
}

function getProviders(mysqli $dbConn){
    try{
    $record = [];
    $sql = "SELECT * FROM `provider`";
    $query = $dbConn->query($sql);
    $rows = $query->num_rows;
    if($rows > 0){
        while($response = $query->fetch_object()){
            $record[] = $response;
        }
    }
    return $record;
    }catch(\mysqli_sql_exception $e){
        die($e->getMessage());
    }
}

function getCities(mysqli $dbConn){
    try{

    $record = [];

    $sql = "SELECT * FROM `cities`";

    $query = $dbConn->query($sql);

    $rows = $query->num_rows;

    if($rows > 0){

        while($response = $query->fetch_assoc()){
            $record[] = $response;
        }

    } 
    return $record;
    }
    catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die($e->getMessage());
    }
};



function setCityProvider(mysqli $dbConn, $id1, $id2){

    try{
        $sql = "UPDATE `cities` SET `cityId` = ? WHERE `cities`.`id` = ?";

        $stmt = $dbConn->prepare($sql);
        
        $stmt->bind_param('ii', $id1, $id2);

        $stmt->execute();

        $result = $stmt->affected_rows;

        if($result){
            printf("Обновени записи: %d", $result); 
        } else {
            die(throw new \mysqli_sql_exception("Грешка при обновяване на данни:\n". $dbConn->error . "\n" 
                                                                                   . $dbConn->errno . "\n"));
        }
    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die($e->getMessage());
    }

}


function getOneProvider(mysqli $dbConn){
    try{ 
        $response = [];
        $sql = "SELECT * FROM `provider` WHERE `deliver` = ? LIMIT 1";
        $stmt = $dbConn->prepare($sql);
        $pn = "Лазур";
        $stmt->bind_param('s', $pn);

        $stmt->execute();

        $result = $stmt->get_result(); 
        
        while($response = $result->fetch_assoc()){
            $link = "edit1.php";
            printf('<table><tr><th>Доставчик</th><th>Булстат</th><th>Лице за контакти</th></tr><tr><td>%s</td><td>%s</td><td>%s</td></tr><tfoot><tr><td colspan="3"><a href="%s">Редактиране</td></tr></tfoot></table>', $response['deliver'], $response['bulsat'], $response['person'], $link);
        };   
                
        $stmt->close();
        $response;
    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die(throw new \mysqli_sql_exception($e->getMessage(), $e->getCode()));
    }
}


function updateOneProvider(mysqli $dbConn){
    try{ 
        $sql = "UPDATE `provider` 
                SET `bulsat` = ?,
                `person` = ?, 
                `deliver` = ?
                WHERE `bulsat` = ? 
                AND `person` = ? 
                AND `deliver` = ?";

        $stmt = $dbConn->prepare($sql);

        /**new data */
        $d_u = "Лазур";
        $p_u = "Лили Петкова";
        $b_u = "00000856231";

        /**old data */
        $d_o = "Лазур";
        $p_o = "Мария Руменова";
        $b_o = "00000856231";

        /**end new */
        $stmt->bind_param('ssssss', $b_u, $p_u, $d_u, $b_o, $p_o, $d_o);
        
        $stmt->execute();
        $result = $stmt->get_result();
        if(!$result){
            echo '<div class="msg-success">Записът е обновен успешно.
            <div class="msg-body">Redirecting...</div></div>';
            sleep(5);
            header("Location: update1.php", true, 303);
            exit;
        } else {
            sleep(5);
            header("Location: update1.php");
            die(throw new \mysqli_sql_exception("Грешка при обновяване на данни:\n". $dbConn->error . "\n" 
                                                                                   . $dbConn->errno . "\n"));
        }
        
        $stmt->close();
    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die(throw new \mysqli_sql_exception($e->getMessage(), $e->getCode()));
    }
}