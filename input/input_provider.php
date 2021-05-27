<?php
require_once "../data/config.php";
require_once "../base/functions.php";
require_once "../views/partials/header.php";
?>
    <form action="input_provider.php" method="post">
    <div class="form-input">Deliver: <input type="text" name="dlvr"></div>
    <div class="form-input">Bulstat: <input type="text" name="blst"></div>
    <div class="form-input">Address: 
    <select name="addr">
    <option disabled selected>---Choose---</option>
    <?php
        $dropdown_res = getCities($dbConn);
        foreach($dropdown_res as $option){
            echo "<option>" . $option["city"] . "</option>";
        }
    ?>
    </select>
    </div>

    <div class="form-input">Telephone: <input type="text" name="phone"></div>
    <div class="form-input">Year of registry: <input type="text" name="yr"></div>
    <div class="form-input">Person: <input type="text" name="person">
    <input type="submit" name="submit" value="Add" /></div>
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
                        $ids = htmlentities($dbConn->real_escape_string($cti["id"])); //get selected Id
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
        <th>Deliver</th>
        <th>Bulstat</th>
        <th>Address</th>
        <th>Telephone</th>
        <th>Year of registry</th>
        <th>Person</th>
        </tr>
        
        <?php 
            $getProvider = getProviders($dbConn);
            
            if($getProvider !== null && count($getProvider) > 0):

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
            <td colspan="6">No records found</td>
            </tr>
        <?php endif; ?>
    </table>

    </div>
</body>
</html>