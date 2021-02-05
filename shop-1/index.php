<?php 
    if(!isset($_GET['office'])){
        header("Location: index.php");
    } else {
        include '../engine/conn.php';
        include '../engine/engine.php';
        $siteData = siteData($conn, $_GET['office']);
    }
?>
<!DOCTYPE html>
<html>
    <?php include 'headtags.php'; ?>
<body>
  
    <?php include 'menu.php'; ?>

    <?php include 'home-header.php'; ?>

    <?php include 'home-products.php'; ?>

    <?php include 'home-info.php'; ?>
    
    <?php include 'contact-section.php'; ?>

    <?php include 'footer.php'; ?>
  
    <?php include 'js-includes.php'; ?>

    <?php include 'whatsapp-icon.php'; ?>

</body>
</html>