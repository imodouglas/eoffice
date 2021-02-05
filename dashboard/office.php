<?php
    if(!isset($_GET['id'])){
        header("Location: home.php");
    } else {
        include '../engine/conn.php';
        include '../engine/engine.php';
        if(isset($_SESSION['eo_user_session'])){
            $userData = userData($conn,$_SESSION['eo_user_session']);
        } else {
            header("Location: index.php");
        }
        if(checkOffice ($conn,$_GET['id'], $userData['userID']) == 0){
            header("Location: home.php");
        }
        
        $officeID = $_GET['id'];
        $siteData = siteData($conn,$officeID);
    }
?>

<!DOCTYPE html>
<html  >
<head>
    <title>Manage - <?php echo $siteData['officeName']; ?> | eOffice NG</title>
    <meta name="description" content="eOffice Nigeria is online business solution that helps give business owners an online representation of their business / brand. If you don't have an eOffice, then you are not ready for business.">
    <?php include 'includes/tags/header.php'; ?>
  
</head>
<body>
  
<?php include 'includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid">
        <?php include 'includes/publish-notify.php';  ?>
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <!-- <p class="mbr-text mbr-fonts-style display-5">Manage eOffice</p> -->
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong> <?php echo $siteData['officeName']; ?></strong></h1>
                <p align="center"> eOffice Address: <br><a href="<?php echo "https://".$siteData['officeDomain'].".eoffice.ng"; ?>" target="_blank"> <?php echo $siteData['officeDomain'].".eoffice.ng"; ?> </a> </p>
                <div align="center">
                    <div style="max-width:500px">
                        <?php
                            if($siteData['phoneNo'] == ""){
                                echo "<div class='p10'> <i class='fas fa-exclamation-triangle' style='color:red !important'></i> WhatsApp No. not set <a href='options.php?id=".$_GET['id']."'> Set Now</a> </div>";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="row" style="padding:30px 10px">
                        <div class="col-sm-4" style="margin-bottom:20px">
                            <div class="item-container-o" align="center">
                                <div class="item-header" align="center">
                                TEMPLATE
                                </div>
                                <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo $siteData['templateName']; ?> </h1>
                                <div style="border-top:#333 thin solid; padding:5px">
                                <!-- <a href="categories.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Remove </a> -->
                                <a href="template.php?id=<?php echo $_GET['id']; ?>"> Edit </a> | <a href="../shop-1/?office=<?php echo $_GET['id']; ?>" target="_blank"> Preview </a>
                                </div>
                            </div>
                        </div>
                        <?php if($siteData['officeType'] == "Virtual Shop"){ ?>
                            <div class="col-sm-4" style="margin-bottom:20px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                    CATEGORIES
                                    </div>
                                    <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo oCatsct($conn,$officeID); ?> </h1>
                                    <div style="border-top:#333 thin solid; padding:5px">
                                    <!-- <a href="categories.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Remove </a> -->
                                    <span style="color:red">This feature will be available soon </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if($siteData['tsProducts'] == 1){ ?>
                            <div class="col-sm-4" style="margin-bottom:20px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                    PRODUCTS
                                    </div>
                                    <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo oProductsct($conn,$officeID); ?> </h1>
                                    <div style="border-top:#333 thin solid; padding:5px">
                                    <a href="products.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Remove </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($siteData['tsServices'] == 1){ ?>
                            <div class="col-sm-4" style="margin-bottom:20px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                    SERVICES
                                    </div>
                                    <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo oServicesct($conn,$officeID); ?> </h1>
                                    <div style="border-top:#333 thin solid; padding:5px">
                                    <a href="services.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Delete </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($siteData['tsPortfolio'] == 1){ ?>
                            <div class="col-sm-4" style="margin-bottom:20px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                        PORTFOLIO
                                    </div>
                                    <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo oPortfolioct($conn,$officeID); ?> </h1>
                                    <div style="border-top:#333 thin solid; padding:5px">
                                    <a href="portfolio.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Delete </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($siteData['tsAchievements'] == 1){ ?>
                            <div class="col-sm-4" style="margin-bottom:20px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                        ACHIEVEMENTS
                                    </div>
                                    <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo oAcmtct($conn,$officeID); ?> </h1>
                                    <div style="border-top:#333 thin solid; padding:5px">
                                    <a href="achievements.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Delete </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if($siteData['tsGallery'] == 1){ ?>
                            <div class="col-sm-4" style="margin-bottom:20px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                        GALLERY IMAGES
                                    </div>
                                    <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo getGalleryct($conn,$_GET['id']); ?>/10 </php> </h1>
                                    <div style="border-top:#333 thin solid; padding:5px">
                                    <a href="gallery.php?id=<?php echo $_GET['id']; ?>">Add/Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-sm-4" style="margin-bottom:20px">
                            <div class="item-container-o" align="center">
                                <div class="item-header" align="center">
                                OPTIONS
                                </div>
                                <h1 style="padding-top:15px; padding-bottom:15px"> <i class="fas fa-cog"></i> </php> </h1>
                                <div style="border-top:#333 thin solid; padding:5px">
                                <a href="options.php?id=<?php echo $_GET['id']; ?>">Edit Options</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4" style="margin-bottom:20px">
                            <div class="item-container-o" align="center">
                                <div class="item-header" align="center">
                                TOTAL VISITS
                                </div>
                                <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo visitCount($conn, $officeID); ?> </php> </h1>
                                <div style="border-top:#333 thin solid; padding:5px">
                                <a href="visits.php?id=<?php echo $_GET['id']; ?>">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- <div class="image-wrap mt-4">
                    <img src="../assets/images/eoffice-home-1200x869.jpg" alt="eOffice Home Image" title="">
                </div> -->
                <div align="center">
                    <a href="index.php" class="btn btn-primary" style="margin-bottom:20px"> <i class="fas fa-arrow-left"></i> Return to Dashboard </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/modals.php'; ?>

  <script src="https://checkout.flutterwave.com/v3.js"></script>
  <script src="../assets/web/assets/jquery/jquery.min.js"></script>
  <script src="../assets/popper/popper.min.js"></script>
  <script src="../assets/tether/tether.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../assets/dropdown/js/nav-dropdown.js"></script>
  <script src="../assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="../assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="../assets/viewportchecker/jquery.viewportchecker.js"></script>
  <script src="../assets/theme/js/script.js"></script>
  <script src="../engine/js/script.js"></script>

  
  
  
  
  <input name="animation" type="hidden">
  </body>
</html>
