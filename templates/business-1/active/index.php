<?php 
    if(!isset($_GET['office'])){
        header("Location: ../");
    } else {
        include '../engine/conn.php';
        include '../engine/engine.php';
        $siteData = siteData($conn, $_GET['office']);

        if($siteData['themeID'] !== "2"){
            $themeDir = $siteData['templateDir'];
            header("Location: ../".$themeDir."/?office=".$_GET['office']);
        }
    }

?>
<!DOCTYPE html>
<html  >
<head>
    <?php include 'headtags.php'; ?>
</head>
<body>
  
    <?php 
        include 'menu.php'; 

        include 'header.php'; 

        include 'about-us.php'; 

        include 'services.php'; 

        include 'gallery.php'; 

        include 'contact-us.php'; 

        include 'footer.php'; 

        include 'whatsapp-icon.php'; 

        include 'js-include.php'; 
    ?>
  
  
  
</body>
</html>