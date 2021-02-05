<?php    
    include '../engine/conn.php';
    include '../engine/engine.php';
    if(isset($_SESSION['eo_user_session'])){
        $userData = userData($conn,$_SESSION['eo_user_session']);
    } else {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html  >
<head>
    <title><?php echo $userData['uname']; ?> | eOffice NG</title>
    <meta name="description" content="eOffice Nigeria is online business solution that helps give business owners an online representation of their business / brand. If you don't have an eOffice, then you are not ready for business.">
    <?php include 'includes/tags/header.php'; ?>
  
</head>
<body>
  
<?php include 'includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid">
        <div class="row justify-content-center" style="padding-bottom:30px">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong>Hello <?php echo $userData['uname']; ?>!</strong></h1>
                <p class="mbr-text mbr-fonts-style display-4">Here are your eOffices</p>

                <?php if(oOfficesct($conn, $userData['userID']) > 0){ ?>
                    <div class="row ms0">
                        <?php foreach(oOffices($conn, $userData['userID']) AS $office){ $days = round(($office['officeExpiry'] - time()) / 86400); if($days > 1){ $dd = "days"; } else { $dd = "day"; } ?>
                            <div class="col-6 col-sm-3" style="margin-bottom:10px">
                                <div class="item-container-o" align="center">
                                    <div class="item-header" align="center">
                                        <p>
                                            <?php if($office['officeLogo'] !==""){ 
                                                    echo "<img src='../".$office['officeLogo']."' style='max-width:70px; margin:0 !important' />"; 
                                                } else { 
                                                    echo "<img src='../assets/images/logo-only-430x326.png' style='max-width:70px; margin:0 !important' />"; 
                                                } 
                                            ?>
                                        </p>
                                        <?php echo $office['officeName'] ?>
                                        <div style="font-size:12px"> 
                                            <?php 
                                                if($office['officeStatus'] == "published"){
                                                    if($office['officeExpiry'] !== "" && ($days < 31)){ 
                                                        echo "<span style='color:red'> Expires in ".$days." ".$dd." </span>"; 
                                                    } else {
                                                        echo "<span style='color:green'> Published </span>"; 
                                                    }
                                                } else {  echo "<span style='color:red'> Unpublished </span>"; } 
                                            ?> 
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="p10"> <a href="office.php?id=<?php echo $office['officeID'] ?>" class="btn btn-primary w100 m0 p5"> Edit Office </a> </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { echo "<p align='center'><span style='color:red'> You have not created an eOffice yet. </span> </p>"; } ?>
                <div align="center">
                    <a class="btn btn-primary display-4" href="../get-started.php"> <i class="fas fa-plus-circle"></i> &nbsp; Create New eOffice</a>
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
