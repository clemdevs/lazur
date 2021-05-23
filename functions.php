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
        $dbConn->close();
        return $record;
    }
    catch (Exception $e){
        $dbConn->close();
        die($e->getMessage);
    }
} 


function insertProvider(mysqli $dbConn, $d, $b, $a, $t, $y, $p){
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
            die("Грешка при въвеждане на данни:\n". $dbConn->error . "\n" 
                                                . $dbConn->errno . "\n");
        }

        $stmt->close();
        $dbConn->close();
        return $record;
    } catch(Exception $e){
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
    }catch(Exception $e){
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
    catch(Exception $e){
        $dbConn->close();
        die($e->getMessage());
    }
};



function updateCityProvider(mysqli $dbConn, $id1, $id2){
    
    try{
        $sql = "UPDATE `cities` SET `cityId` = ? WHERE `cities`.`id` = ?";

        $stmt = $dbConn->prepare($sql);
        
        $stmt->bind_param('ii', $id1, $id2);

        $stmt->execute();

        $stmt->close();
        $dbConn->close();
    }catch(Exception $e){
        $dbConn->close();
        die($e->getMessage());
    }

}


function getOneProvider(mysqli $dbConn){
    
    try{ 
        $sql = "SELECT `(deliver, bulsat, person)` FROM `provider` WHERE `provider`.`deliver` = ?";
        $stmt = $dbConn->prepare($sql);
        
        $stmt->bind_param('s', $d);

        $stmt->execute();

        $result = $stmt->get_result(); 
        
        while($response = $result->fetch_assoc()){
            printf('<table><tr><th>Доставчик</th><th>Булстат</th><th>Лице за контакти</th></tr><tr><td>%s</td>, <td>%s</td>, <td>%s</td></tr></table>', $response['deliver'], $response['bulsat'], $response['person']);
        };   
                
        $stmt->close();
        $dbConn->close();

        return $response;
    }catch(Exception $e){
        $dbConn->close();
        die($e->getMessage());
    }

}




