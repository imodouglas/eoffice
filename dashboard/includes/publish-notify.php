<?php 
    if($siteData['officeType'] == "Virtual Office"){
        $eoNprice = "N1,000";
    } else if($siteData['officeType'] == "Virtual Shop"){
        $eoNprice = "N5,000";
    }
    $days = round(($siteData['officeExpiry'] - time()) / 86400);
?>

<?php if($siteData['officeStatus'] == "unpublished"){ ?>
    <div class="p10 eo-dark-bg radius5" align="center"> Your eOffice is not published and cannot be seen by the public. To make your eOffice public, <a href="#" class="btn btn-primary" style="padding:3px 10px" onclick="doPublish(<?php echo $siteData['officeID']; ?>)">Publish Now</a> for just <?php echo $eoNprice; ?>. </div>
<?php } else if($siteData['officeExpiry'] !== "" && ($days < 31)){ ?>
    <div class="p10 eo-dark-bg radius5" align="center"> Your eOffice is expiring in <?php echo $days." days"; ?> <a href="#" class="btn btn-primary" style="padding:3px 10px" onclick="doPublish(<?php echo $siteData['officeID']; ?>)">Renew Now</a> for 1 more year at <?php echo $eoNprice; ?> only. </div>
<?php } ?>