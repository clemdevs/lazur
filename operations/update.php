<?php
    require_once "../data/config.php";
    require_once "../base/functions.php";
    include_once "../views/partials/header.php";

    $providers = getProviders($dbConn);

    if(count($providers) > 0):
    echo "<h3>Deliver, person</h1>";
    foreach ($providers as $prov):
?>
    <ol><?php echo "$prov->id.  $prov->deliver, $prov->person";?></ol>

<?php endforeach; 
      else:
        echo "<b>No records found</b>";
      endif; ?>

    </div>
  </body>
</html>