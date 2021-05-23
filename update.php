<?php
    require_once "config.php";
    require_once "functions.php";

    $providers = getProviders($dbConn);

    if(count($providers) > 0):
    echo "Доставчик, лице за контакти";
    foreach ($providers as $prov):
?>
    <ol><?php echo "{$prov->id}.  {$prov->deliver}, {$prov->person}";?></ol>

<?php endforeach; 
      else:
        echo "<b>Няма записи</b>";
      endif; ?>


