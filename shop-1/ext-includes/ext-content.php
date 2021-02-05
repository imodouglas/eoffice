<?php 
    if(isset($_GET['oid'])){
        $siteURL = "http://localhost/eoffice";
        $officeID = $_GET['oid'];
    }
    $siteData = json_decode(file_get_contents($siteURL."/engine/data.php?get=sitedata&eoid=1"), true); 
    $tempDir = $siteData['templateDir'];
?>
<!DOCTYPE html>
<html>
    <?php include $siteURL.'/'.$tempDir.'/ext-includes/headtags.php'; ?>
<body>
  
    <?php include $siteURL.'/'.$tempDir.'/menu.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/home-header.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/home-products.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/home-info.php'; ?>
    
    <?php include $siteURL.'/'.$tempDir.'/contact-section.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/footer.php'; ?>
  
    <?php include $siteURL.'/'.$tempDir.'/ext-includes/js-includes.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/whatsapp-icon.php'; ?>

</body>
</html>