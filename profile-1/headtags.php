  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <?php if($siteData['officeLogo'] == ""){ ?><link rel="shortcut icon" href="<?php echo $siteData['siteURL']."/assets/images/logo-only-128x97.png"; ?>" type="image/x-icon"> <?php } else { ?>
    <link rel="shortcut icon" href="<?php echo $siteData['siteURL']."/".$siteData['officeLogo']; ?>" type="image/x-icon">
  <?php } ?>
  <title><?php echo $siteData['officeName']; ?> | eOffice NG</title>
  <meta name="description" content="<?php echo $siteData['officeDesc']; ?>">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/web/assets/mobirise-icons2/mobirise2.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/tether/tether.min.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/socicon/css/styles.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/theme/css/style.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']; ?>/assets/fontawesome/css/all.css">
  <link rel="preload" as="style" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="<?php echo $siteData['siteURL']."/".$siteData['templateDir']; ?>/assets/mobirise/css/mbr-additional.css" type="text/css">
  <script src="https://kit.fontawesome.com/37929f92f4.js" crossorigin="anonymous"></script>