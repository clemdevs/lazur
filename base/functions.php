<?php

require_once "../data/config.php";

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
            printf("Number of towns inserted: %d", $rows); 
        } else {
            die(throw new \mysqli_sql_exception("Error inserting data:\n"       . $dbConn->error . "\n" 
                                                                                . $dbConn->errno . "\n"));
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

        if($result > 0){
            printf('<div class="success-msg"><div class="msg-title">Success</div><div class=msg-body>Number of providers inserted: %d</div></div>', $result); 

        } else {
            die(throw new \mysqli_sql_exception('<div class="error-msg">Error inserting data:</div>' . "\n"
            .'<div class="msg-body>"'
            . $dbConn->error . "\n" 
            . $dbConn->errno . "\n"
            .'</div>'));
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
    if($query !== false){
    $rows = $query->num_rows;
    } else {
        die('<div class="error-msg"><div class="msg-title">Error</div><div class="msg-body">The selected table doesn\'t exist.</div>');
    }
    if($rows !== false && $rows > 0){
        while($response = $query->fetch_object()){
            $record[] = $response;
        }
        return $record;
    } 
    }catch(\mysqli_sql_exception $e){
        die('<div class="error-msg"><div class="msg-title">Error</div><div class="msg-body">The selected table doesn\'t exist.</div>');
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

        // $result = $stmt->affected_rows;

        // if($result > 0){
        //     printf('Updated Records: %d', $result); 
        // } else {

        //     die(throw new \mysqli_sql_exception('Error updating new record:' . "\n"     . $dbConn->error . "\n" 
        //     . $dbConn->errno . "\n"));
        // }
    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die($e->getMessage());
    }

}


function getOneProviderUpdate(mysqli $dbConn){
    try{ 
        $response = [];
        $sql = "SELECT * FROM `provider` WHERE `deliver` = ?";
        $stmt = $dbConn->prepare($sql);
        $pn = "Лазур";

        $stmt->bind_param('s', $pn);

        $stmt->execute();

        $result = $stmt->get_result(); 
        
        while($response = $result->fetch_assoc()){
            $link = "../operations/update1-action.php";
            printf('<table><tr><th>Deliver</th><th>Bulstat</th><th>Person</th></tr><tr><td>%s</td><td>%s</td><td>%s</td></tr><tfoot><tr><td colspan="3"><a href="%s">Edit</td></tr></tfoot></table>', $response['deliver'], $response['bulsat'], $response['person'], $link);
        };   
                
        $stmt->close();
        return $response;
    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die(throw new \mysqli_sql_exception($e->getMessage(), $e->getCode()));
    }
}


function getOneProviderDelete(mysqli $dbConn){
    try{ 
        $response = [];
        $sql = "SELECT * FROM `provider` WHERE `deliver` = ?";
        $stmt = $dbConn->prepare($sql);
        $d = "Орхидея";
        $stmt->bind_param('s', $d);

        $stmt->execute();

        $result = $stmt->get_result(); 

        $rows = $stmt->affected_rows;

        while($response = $result->fetch_assoc()){
            $link = "delete1-action.php";
            printf('<table><tr><th>Deliver</th><th>Bulstat</th></tr><tr><td>%s</td><td>%s</td></tr><tfoot><tr><td colspan="2"><a href="%s">Delete</td></tr></tfoot></table>', $response['deliver'], $response['bulsat'], $link);
        }; 

        if($rows > 0){
            return $response;
        } else {
            print("No Data found");
            exit;
        }
        $stmt->close();

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

        /**updated data */
        $d_u = "Лазур";
        $p_u = "Лили Петкова";
        $b_u = "00000856231";

        /**old data */
        $d_o = "Лазур";
        $p_o = "Мария Руменова";
        $b_o = "00000856231";

        $stmt->bind_param('ssssss', $b_u, $p_u, $d_u, $b_o, $p_o, $d_o);
        
        $stmt->execute();
        $result = $stmt->affected_rows;
        if(!$result){
            echo '<div class="msg-success"><div class="msg-title">Record is updated successfully.</div>
            <div class="msg-body">Redirecting...</div></div>';
            sleep(5);
            header("Location: update1.php", true, 303);
            exit;
        } else {
            sleep(10);
            die(throw new \mysqli_sql_exception("Error updating data:\n"        . $dbConn->error . "\n" 
                                                                                . $dbConn->errno . "\n"));
            header("Location: update1.php", true, 303);

        }
        
        $stmt->close();
    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die(throw new \mysqli_sql_exception($e->getMessage(), $e->getCode()));
    }
}


function deleteOneProvider(mysqli $dbConn){
    try{
        $sql = "DELETE FROM `provider` WHERE `bulsat` = ? AND `deliver` = ?";
        $stmt = $dbConn->prepare($sql);
        $d = "Орхидея";
        $b = "005417863";
        $stmt->bind_param('ss', $b, $d);
        $stmt->execute();
        $result = $stmt->affected_rows;

        if(!$result){
            printf("Deleted provider: %d", $result); 
            sleep(5);
            header("Location: delete1.php", true, 303);
        } else {
            die(throw new \mysqli_sql_exception("Error deleting data:\n"        . $dbConn->error . "\n" 
                                                                                . $dbConn->errno . "\n"));
        }
        $stmt->close();

    }catch(\mysqli_sql_exception $e){
        $dbConn->close();
        die(throw new \mysqli_sql_exception($e->getMessage(), $e->getCode()));
    }
}