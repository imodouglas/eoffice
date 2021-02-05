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
    <title><?php echo $userData['fname']; ?> | eOffice NG Affiliate Dashboard</title>
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
                <p align="center"> Your Affiliate URL: </p><p align="center"><a href="<?php echo "https://eoffice.ng/?ref=".$userData['userID']; ?>" target="_blank"> <?php echo "https://eoffice.ng/?ref=".$userData['userID']; ?> </a> </p>
                <div align="center">
                    <div style="max-width:500px">
                        <?php
                            if(getWalletct($conn,$userData['userID']) == 0){
                                echo "<div class='p10'> <i class='fas fa-exclamation-triangle' style='color:red !important'></i> Update your cashout bank details <button class='btn btn-primary' style='padding:3px 10px' onclick='showWallet()'>Set Now</button> </div>";
                            }
                        ?>
                    </div>
                </div>
                
                <div class="row" style="padding:30px 10px">
                    <div class="col-sm-2" style="margin-bottom:20px"></div>
                    <div class="col-sm-4" style="margin-bottom:20px">
                        <div class="item-container-o" align="center">
                            <div class="item-header" align="center">
                                YOUR REFERRALS
                            </div>
                            <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo refOfficesct($conn,$userData['userID']); ?> </h1>
                            <p> <?php echo refOfficesTypect($conn,$userData['userID'],"published"); ?> - Published </p>
                            <p> <?php echo refOfficesTypect($conn,$userData['userID'],"unpublished"); ?> - Unpublished </p>
                            <div style="border-top:#333 thin solid; padding:5px">
                                <a href="eoffices.php"> See All </a> 
                            </div>
                        </div>
                    </div>
                        
                    <div class="col-sm-4" style="margin-bottom:20px">
                        <div class="item-container-o" align="center">
                            <div class="item-header" align="center">
                                YOUR WALLET
                            </div>
                            <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo "N".number_format((totalEarnings($conn,$userData['userID'])['total'] - totalCashouts($conn,$userData['userID'])['total']),2); ?> </h1>
                            <p> Total Earnings: <?php echo "N".number_format(totalEarnings($conn,$userData['userID'])['total'],2); ?> </p>
                            <p> Total Cashouts: <?php echo "N".number_format(totalCashouts($conn,$userData['userID'])['total'],2); ?> </p>
                            <div style="border-top:#333 thin solid; padding:5px">
                                <!-- <a href="categories.php?id=<?php echo $_GET['id']; ?>"> Add/Edit/Remove </a> -->
                                <a href="wallet.php"> Open Wallet </a> | <a href="#" onclick="showWallet()"> Bank Details </a>
                            </div>
                        </div>
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
