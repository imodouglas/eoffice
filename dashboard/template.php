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
    }

    $officeID = $_GET['id'];
    $siteData = siteData($conn,$officeID);

    include '../'.$siteData['templateDir'].'/processor.php';
?>

<!DOCTYPE html>
<html  >
<head>
    <title>Edit Template - <?php echo $siteData['officeName']; ?> | eOffice NG</title>
    <meta name="description" content="eOffice Nigeria is online business solution that helps give business owners an online representation of their business / brand. If you don't have an eOffice, then you are not ready for business.">
    <?php include 'includes/tags/header.php'; ?>
  
</head>
<body>
  
<?php include 'includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2" style="padding:30px 10px">
        <div class="container">
          <?php include 'includes/publish-notify.php';  ?>
            <a href="office.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary" style="margin-bottom:20px"> <i class="fas fa-arrow-left"></i> Return to Manager </a>
            <a href="../<?php echo $siteData['templateDir']; ?>/?office=<?php echo $_GET['id']; ?>" class="btn btn-primary" style="margin-bottom:20px" target="_blank"> <i class="far fa-eye"></i> Preview  </a>
          <div class="row">
            <div class="col-sm-8">
              <div class="item-container">
                <div class="item-header">
                  Edit <?php echo $siteData['templateName']; ?>
                </div>
                <div style="border-top:#333 thin solid; padding:5px">
                  <form method="post" enctype="multipart/form-data" action="">
                    <?php include '../'.$siteData['templateDir'].'/editor.php'; ?>
                    <input type="submit" name="updateTheme" class="btn btn-primary form-control" style="padding: 2px 2px 2px 2px" value="Update Theme" />
                  </form>
                </div>
              </div>
            </div>

            <div class="col-sm-4">

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
