<?php 
    if(!isset($_GET['office'])){
        header("Location: ../");
    } else {
        include '../engine/conn.php';
        include '../engine/engine.php';
        $siteData = siteData($conn, $_GET['office']);

        if($siteData['themeID'] !== "3"){
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

        include 'summary.php'; 

        include 'about.php'; 

        include 'portfolio.php';
        
        include 'achievements.php'; 

        include 'contact.php'; 

        include 'footer.php'; 

        include 'whatsapp-icon.php'; 

        include 'js-includes.php'; 
    ?>
  
  
  
</body>
</html>