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
    }
    if(checkOffice ($conn,$_GET['id'], $userData['userID']) == 0){
        header("Location: home.php");
    }

    $officeID = $_GET['id'];
    $siteData = siteData($conn,$officeID);
    if(isset($_GET['show']) && $_GET['show'] == "all"){
        $visitData = visitData($conn, $officeID);   
    } else {
        $visitData = visitDataMonth($conn, $officeID);
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

    <section class="header6 cid-s5u5s3HuN0" id="header6-2" style="padding:30px 10px">
        <div class="container">
            <?php include 'includes/publish-notify.php';  ?>
            <a href="office.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary" style="margin-bottom:20px"> <i class="fas fa-arrow-left"></i> Return to Manager </a>
            <div class="row">
                <div class="col-sm-12">
                    <div class="item-container">
                        <div class="item-header">
                            <p>VISITORS DETAILS: </p>
                            <p> <?php echo "<b>Total Visits: </b>".visitCount($conn,$officeID); ?> Visitor(s) </p> <p> <?php echo "<b>Last 1 month: </b>".visitCountMonth($conn,$officeID); ?> Visitor(s) </p>
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px;">
                        <?php foreach($visitData as $visitData){
                            // $loca = file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=$api_key&ip=$ipaddress&format=json");
                            // $loca = json_decode($data);
                            // $country = $data['Country'];
                            if($visitData['visitorIP'] !== "unknown"){
                                $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $visitData['visitorIP'])); 
                                $country = $ipdat->geoplugin_countryName; 
                            } else {
                                $country = "Unknown Location"; 
                            }
                        ?>
                            <div class="row" style="border-bottom:#ccc thin solid; padding:5px; margin-bottom:5px">
                                <div class="col-sm-5" style="padding:3px"> <strong>Visited:</strong> <?php echo date("d M, Y - h:ia", $visitData['visitTime']); ?> </div>
                                <div class="col-sm-4" style="padding:3px"> <strong>From:</strong> <?php echo $country; ?> </div>
                                <div class="col-sm-3" style="padding:3px"> <strong>Using:</strong> <?php echo $visitData['visitorDevice']; ?> </div>
                            </div>
                        <?php } ?>
                        </div>
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
