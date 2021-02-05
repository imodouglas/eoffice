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
    <title><?php echo $userData['fname']; ?>'s Wallet | eOffice NG Affiliate Dashboard</title>
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
                            <p> 
                                <a href="home.php" class="btn btn-primary" style="padding:5px 10px"> <i class="fas fa-arrow-left"></i> Return to home </a> 
                                <a href="#" class="btn btn-primary" style="padding:5px 10px" onclick='doCashout()'> <i class="fas fa-credit-card"></i> Request Cashout </a> 
                            </p>
                        </div>
                        <div class="eo-dark-bg" align="center" style="border-top:#333 thin solid; border-bottom:#333 thin solid; padding-top:10px">
                            <p> BALANCE: <?php echo "N".number_format((totalEarnings($conn,$userData['userID'])['total'] - totalCashouts($conn,$userData['userID'])['total']),2); ?> </p>
                        </div>
                    </div>
                    
                    <div class="row" style="padding:30px 10px">
                        <div class="col-sm-6 p10" align="left" id="earnings">
                            <div class="p10" style="border:#333 thin solid">
                                <h4 align="center"> Your Earnings </h4>
                                <p align="center" class="show-sm" style="color:#070" onclick="toggleWallet()"> Show Cashouts <i class="fas fa-arrow-right"></i> </p>
                                <?php if(getEarningsct($conn, $userData['userID']) > 0){ ?>
                                    <?php foreach(getEarnings($conn, $userData['userID']) AS $earning){ ?>
                                        <div class="row ms0" style="border-bottom:#333 thin solid">
                                            <div class="col-sm-6" style="padding:5px;">
                                                <?php echo $earning['earningDesc']; ?>
                                            </div>
                                            <div class="col-sm-3" style="padding:5px;">
                                                <?php echo "N".number_format($earning['earningAmount'],2); ?>
                                            </div>
                                            <div class="col-sm-3" style="padding:5px;">
                                                <?php echo date("d/m/Y", $earning['earningTime']); ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { echo "<p align='center'><span style='color:red'> You don't have any earnings yet. </span> </p>"; } ?>
                                <div class="p10 eo-dark-bg"> <h4 style="margin-bottom:0;" align="center"> Total: <?php echo "N".number_format(totalEarnings($conn,$userData['userID'])['total'],2); ?> </h4> </div>
                            </div>
                        </div>

                        <div class="col-sm-6 show-lg p10" align="left" id="cashouts">
                            <div class="p10" style="border:#333 thin solid">
                                <h4 align="center"> Your Cashouts </h4>
                                <p align="center" class="show-sm" style="color:#070" onclick="toggleWallet()"> <i class="fas fa-arrow-left"></i> Show Earnings </p>
                                <?php if(getCashoutsct($conn, $userData['userID']) > 0){ ?>
                                    <?php foreach(getCashouts($conn, $userData['userID']) AS $cashout){ ?>
                                        <div class="row ms0" style="border-bottom:#333 thin solid">
                                            <div class="col-sm-6" style="padding:5px;">
                                                <?php echo $cashout['cashoutDesc']; ?> <br> <span style="color:#070; font-size:12px"> <?php echo date("d M,Y - h:ia", $cashout['cashoutTime']); ?> </span>
                                            </div>
                                            <div class="col-sm-4" style="padding:5px;">
                                                <?php echo "N".number_format($cashout['cashoutAmount'],2); ?>
                                            </div>
                                            <div class="col-sm-2" style="padding:5px;">
                                                <?php echo $cashout['cashoutStatus']; ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { echo "<p align='center'><span style='color:red'> You have done any cashout yet. </span> </p>"; } ?>
                                <div class="p10 eo-dark-bg"> <h4 style="margin-bottom:0;" align="center"> Total: <?php echo "N".number_format(totalCashouts($conn,$userData['userID'])['total'],2); ?> </h4> </div>
                            </div>
                        </div>

                        <div class="col-12 mt20" align="center"> 
                            <a href="home.php" class="btn btn-primary" style="padding:5px 10px"> <i class="fas fa-arrow-left"></i> Return to home </a> 
                            <a href="#" class="btn btn-primary" style="padding:5px 10px" onclick='doCashout()'> <i class="fas fa-credit-card"></i> Request Cashout </a> 
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
        $("#coAmount").keyup(function(){
            $.get(siteURL+"/engine/data.php?get=wallet-balance", function(data){
                if($("#coAmount").val() > data){
                    $("#coerror1").show();
                    $("#coerror1").html("You can't withdraw more than N"+data);
                } else {
                    $("#coBtn").show();
                    $("#coerror1").hide();
                }
            });
        });

        $("#coForm").submit(function(e){
            e.preventDefault();
            var fData = $(this).serialize();
            $.get(siteURL+"/engine/data.php?get=wallet-balance", function(data){
                if($("#coAmount").val() > data){
                    alert("You can't withdraw more than N"+data);
                } else {
                    $.post(siteURL+"/engine/data.php", fData, function(data1){
                        if(data1 == 1){
                            alert('Cashout Successful!');
                            location.reload(true);
                        } else {
                            alert('An error occured! Try again.');
                        }
                    });
                }
            });
        });

        function showWallet(){
            $("#bankInfo").fadeToggle("fast");
        }
        function editWallet(){
            $("#bankDisplay").slideToggle("fast");
            $("#bankForm").slideToggle("fast");
        }

        function toggleWallet(){
            $("#earnings").slideToggle("fast");
            $("#cashouts").slideToggle("fast");
        }

        function doCashout(){
            $("#doCashout").fadeToggle("fast");
        }
    </script>

    <input name="animation" type="hidden">
</body>

</html>
