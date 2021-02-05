<?php 
    include 'engine/conn.php';
    include 'engine/engine.php';
?>

<?php 
    foreach(allOfficesType($conn,"published") AS $office){
        echo "<a href=https://".$office['officeDomain'].".eoffice.ng>".$office['officeName']."</a> <br>";
    }
?>