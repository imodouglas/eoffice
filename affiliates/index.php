<?php 
    include '../engine/conn.php';
    include '../engine/engine.php';
?>
<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo-only-128x97.png" type="image/x-icon">
  <meta name="description" content="eOffice Nigeria is an online business solution that helps give business owners an online representation of their business / brand. If you don't have a website, then you are not ready for business.">
  
  <title>eOffice NG - Affiliate Program</title>
  <?php include '../dashboard/includes/tags/header.php'; ?>
  
</head>
<body>
  
    <?php include '../dashboard/includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong>eOffice NG Affliate Program</strong></h1>
                <p class="mbr-text mbr-fonts-style display-5">Earn 20% on all your referrals</p>
                    <div align="center">
                        <a href="account.php" class="btn btn-primary display-4" id="gsBtn">Continue &nbsp;<i class="fas fa-arrow-circle-right"></i> </a>
                    </div>
                        
                <div class="image-wrap mt-4">
                    <img src="../assets/images/eoffice-home-1200x869.jpg" alt="eOffice Home Image" title="">
                </div>
            </div>
        </div>
    </div>
</section>


    <?php 
        include '../dashboard/includes/footer.php'; 
        include 'includes/js-includes.php'; 
    ?>
    

    <script>
        $("#officedomain").keyup(function(){
            var eodomain = $("#officedomain").val();
            var newString = eodomain.replace(/[^-A-Z0-9]+/ig, "");
            newString = newString.toLowerCase();
            $("#officedomain").val(newString);
        });

        $("#gsBtn").click(function(){
            console.log("done!");
            checkDomain($("#officedomain").val());
        });
    </script> 
  
  
  
  <input name="animation" type="hidden">
  </body>
</html>