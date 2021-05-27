<?php

require_once "../data/config.php";
require_once "../base/functions.php";
require_once "../views/partials/header.php";
?>
<div class="container">
<form action="input_town.php" method="post">
        <label>Town:</label> <input type="text" name="city" />
        <input type="submit" name="submit" value="Add"/>
</form>


<?php


if (isset($_POST["submit"])){
    
    $city = htmlentities($_POST['city']);
    
    if(!empty($city)){
        
    $records[] = insertCity($dbConn, $city);

    } else {
        die("You must choose a town first.");
    }
} 
?>

<table>
    <tr>
    <th>№</th>
    <th>Town</th>
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
        <td colspan="2">No records found</td>
        </tr>
        <?php
    endif;

    ?>

</tr>
</table>
</div>
</body>
</html>