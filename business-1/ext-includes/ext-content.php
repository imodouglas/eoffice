<?php 
    if(isset($_GET['oid'])){
        $siteURL = "http://localhost/eoffice";
        $officeID = $_GET['oid'];
    }
    $siteData = json_decode(file_get_contents($siteURL."/engine/data.php?get=sitedata&eoid=".$officeID), true); 
    $tempDir = $siteData['templateDir'];
?>
<!DOCTYPE html>
<html>
    <?php include $siteURL.'/'.$tempDir.'/ext-includes/headtags.php'; ?>
<body>
  
    <?php include $siteURL.'/'.$tempDir.'/menu.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/header.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/about-us.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/services.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/gallery.php'; ?>
    
    <?php include $siteURL.'/'.$tempDir.'/contact-us.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/footer.php'; ?>
  
    <?php include $siteURL.'/'.$tempDir.'/ext-includes/js-includes.php'; ?>

    <?php include $siteURL.'/'.$tempDir.'/whatsapp-icon.php'; ?>

</body>
</html>