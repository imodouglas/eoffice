<?php
    include '../engine/conn.php';
    include '../engine/engine.php';
    if(isset($_SESSION['eo_user_session'])){
        $userData = userData($conn,$_SESSION['eo_user_session']);
    } else {
        header("Location: account.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $userData['fname']; ?>'s Referrals | eOffice NG Affiliate Dashboard</title>
    <meta name="description" content="eOffice Nigeria is an online business solution that helps give business owners an online representation of their business / brand. If you don't have a website, then you are not ready for business.">
    <?php include '../dashboard/includes/tags/header.php'; ?>  
</head>
<body>
  
    <?php include '../dashboard/includes/menu.php'; ?>

    <section class="header6 cid-s5u5s3HuN0" id="header6-2">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-9">
                    <!-- <p class="mbr-text mbr-fonts-style display-5">Manage eOffice</p> -->
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-2"><strong> <?php echo "Hello ".$userData['fname']."!"; ?></strong></h1>
                    <p align="center"> Your Affiliate URL: <a href="<?php echo "https://eoffice.ng/?ref=".$userData['userID']; ?>" target="_blank"> <?php echo "https://eoffice.ng/?ref=".$userData['userID']; ?> </a> </p>
                    <div align="center">
                        <div style="max-width:500px">
                            <?php
                                if(getWalletct($conn,$userData['userID']) == 0){
                                    echo "<div class='p10'> <i class='fas fa-exclamation-triangle' style='color:red !important'></i> Update your cashout bank details <button class='btn btn-primary' style='padding:3px 10px' onclick='showWallet()'>Set Now</button> </div>";
                                }
                            ?>
                            <p> <a href="home.php" class="btn btn-primary" style="padding:5px 10px"> <i class="fas fa-arrow-left"></i> Return to home </a> </p>
                        </div>
                    </div>
                    
                    <div class="row" style="padding:30px 10px">
                        <div class="col-12" align="center"> <h4> Your Referrals </h4> </div>
                        <div class="col-12" align="left">
                            <?php if(refOfficesct($conn, $userData['userID']) > 0){ ?>
                                <div class="row show-lg">
                                    <div class="col-sm-4" style="padding:10px; background:#333; color:#fff">
                                        eOffice Name
                                    </div>
                                    <div class="col-sm-2" style="padding:10px; background:#333; color:#fff">
                                        eOffice Type
                                    </div>
                                    <div class="col-sm-2" style="padding:10px; background:#333; color:#fff">
                                        Created Date
                                    </div>
                                    <div class="col-sm-2" style="padding:10px; background:#333; color:#fff">
                                        Expiry Date
                                    </div>
                                    <div class="col-sm-2" style="padding:10px; background:#333; color:#fff">
                                        Status
                                    </div>
                                </div>

                                <?php foreach(refOffices($conn, $userData['userID']) AS $office){ ?>
                                    <div class="row" style="border-bottom:#333 thin solid">
                                        <div class="col-sm-4" style="padding:10px;">
                                            <strong class="show-sm eo-label">Office Name: </strong> <a href="<?php echo $siteURL."/".$office['officeDomain']; ?>" target="_blank"> <?php echo $office['officeName']; ?> </a>
                                        </div>
                                        <div class="col-sm-2" style="padding:10px;">
                                            <strong class="show-sm eo-label">Office Type: </strong> <?php echo $office['officeType']; ?>
                                        </div>
                                        <div class="col-sm-2" style="padding:10px;">
                                            <strong class="show-sm eo-label">Created: </strong> <?php echo date("d M, Y", $office['officeCreated']); ?>
                                        </div>
                                        <div class="col-sm-2" style="padding:10px;">
                                            <strong class="show-sm eo-label">Expiring: </strong> <?php if($office['officeExpiry'] !== ""){ echo date("d M, Y", $office['officeExpiry']); } else { echo "Not set"; } ?>
                                        </div>
                                        <div class="col-sm-2" style="padding:10px;">
                                            <strong class="show-sm eo-label">Office Status: </strong> <?php echo $office['officeStatus']; ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } else { echo "<p align='center'><span style='color:red'> You don't have any referral yet. </span> </p>"; } ?>
                            
                            <p align="center"> <a href="home.php" class="btn btn-primary" style="padding:5px 10px"> <i class="fas fa-arrow-left"></i> Return to home </a> </p>
                        </div>
                        
                    </div>
                    <!-- <div class="image-wrap mt-4">
                        <img src="../assets/images/eoffice-home-1200x869.jpg" alt="eOffice Home Image" title="">
                    </div> -->
                    <!-- <div align="center">
                        <a href="index.php" class="btn btn-primary" style="margin-bottom:20px"> <i class="fas fa-arrow-left"></i> Return to Dashboard </a>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <?php 
        include '../dashboard/includes/footer.php'; 
        include 'includes/js-includes.php'; 
        include 'includes/modals.php'; 
    ?>

    <script>
        function showWallet(){
            $("#bankInfo").fadeToggle("fast");
        }
        function editWallet(){
            $("#bankDisplay").slideToggle("fast");
            $("#bankForm").slideToggle("fast");
        }
    </script>

    <input name="animation" type="hidden">
</body>

</html>
