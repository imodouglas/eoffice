  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <?php if($siteData['officeLogo'] == ""){ ?><link rel="shortcut icon" href="<?php echo $siteData['siteURL']."/"."/assets/images/logo-only-128x97.png"; ?>" type="image/x-icon"> <?php } else { ?>
    <link rel="shortcut icon" href="<?php echo echo $siteData['siteURL']."/".$siteData['officeLogo']; ?>" type="image/x-icon">
  <?php } ?>
  <title><?php echo $siteData['officeName']; ?> | eOffice NG</title>
  <meta name="description" content="<?php echo $siteData['officeDesc']; ?>">
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/gallery/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">