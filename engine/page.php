<?php  
    if(isset($_GET['address'])){
        include 'includes.php'; 
        include '../'.$siteData['templateDir'].'/ext-includes/content.php'; 
    } else {
        header("Location: index.php");
    }
    
?>
