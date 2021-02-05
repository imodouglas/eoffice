<?php    
    include '../engine/conn.php';
    include '../engine/engine.php';
?>

<!DOCTYPE html>
<html  >
<head>
    <title> Marketplace | eOffice NG</title>
    <meta name="description" content="The general marketplace of eOffice Virtual Shop subscibers">
    <?php include 'includes/tags/header.php'; ?>
  
</head>
<body>
  
<?php include 'includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header">
    <div class="container-fluid">
        <div class="row justify-content-center" style="padding-bottom:30px">
            <div class="col-md-12 col-lg-8">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">Welcome to eOffice Marketplace!</h1>
                <p class="mbr-text mbr-fonts-style display-4">Search for anything you want!</p>
                <p>
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Enter product name here" id="officedomain" aria-describedby="basic-addon1">
                        <div class="input-group-append">
                            <span class="input-group-text" style="padding:0; background:none; border:none" id="basic-addon1">
                                <input type="submit" name="srch" style="margin:0; border-radius: 0px 4px 4x 0px !important" class="btn btn-primary" value="Search" />
                            </span>
                        </div>
                    </div>
                </p>
               
                <!-- <div align="center">
                    <a class="btn btn-primary display-4" href="../get-started.php"> <i class="fas fa-plus-circle"></i> &nbsp; Create New eOffice</a>
                </div> -->
            </div>
        </div>
    </div>
</section>

<section style="padding-top:40px" id="featured-products">
    <div class="container-fluid">
        <div class="row justify-content-center" style="padding-bottom:30px" align="center">
            <div class="col-sm-12">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2">Featured products</h1>
            </div>
            <div class="col-sm-3">
                <div style="border-radius:4px; border:#ccc thin solid">
                    
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
