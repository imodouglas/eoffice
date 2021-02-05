<?php 
    session_start();
    if(isset($_GET['ref'])){
        $_SESSION['eo_refID'] = $_GET['ref'];
    }
?>
<!DOCTYPE html>
<html  >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo-only-128x97.png" type="image/x-icon">
  <meta name="description" content="Setup your website or online store in minutes for as low as N1,000 with eoffice.ng. All you need to do is pick a name, select a template and edit it with your content.">
  
  <title>eOffice NG - Your office on the internet</title>
  <?php include 'includes/headtags.php'; ?>
  
</head>
<body>
  
    <?php include 'includes/header.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong>eOffice Nigeria</strong></h1>
                <p class="mbr-text mbr-fonts-style display-5">
                    Setup your business website in minutes!</p>
                    <div align="center">
                            <div style="width:100%; max-width:600px!important">
                                <div class="input-group mb-3">
                                    <input type="text" name="officedomain" class="form-control" placeholder="yourofficename" id="officedomain" aria-describedby="basic-addon1">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon1">.eoffice.ng</span>
                                    </div>
                                </div>
                                <div style="color:red" id="domainError"></div>
                            </div> 
                        </div>
                        <div class="mbr-section-btn mt-3">
                            <button type="submit" name="goto2" class="btn btn-primary display-4" id="gsBtn">Continue &nbsp;<i class="fas fa-arrow-circle-right"></i> </button>
                            <button type="submit" name="goto2" class="btn btn-primary display-4" id="gsLoading" style="display:none"><i class="fas fa-spinner fa-spin"></i>&nbsp; Validating... </button>
                        </div>
                <div class="image-wrap mt-4">
                    <img src="assets/images/eoffice-home-1200x869.jpg" alt="eOffice Home Image" title="">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features6 cid-s5u9itlNOo" id="virtual-office">
    <div class="container">
        <div class="d-flex card-wrapper">
            <div class="image-wrapper">
                <img src="assets/images/content-black-female-using-smartphone-in-bar-4350300-1108x1661.jpeg" alt="Mini Website" title="">
            </div>
            <div class="text-box">
                <h5 class="mbr-title mbr-fonts-style display-2">
                    <strong>Virtual Office</strong></h5>
                <p class="mbr-text mbr-fonts-style display-7">Showcase your business, what you do, your portfolio and contact information in a beautifully designed landing page. It can be setup in just a few minutes with your phone, tablet or PC. Simply select a template from our creative &amp; mobile friendly collection and replace contents with yours. <br><strong>It's that simple!</strong><br></p>
                <div class="cost">
                    <span class="currentcost mbr-fonts-style pr-2 display-2">N1,000/yr</span>
                    <span class="oldcost mbr-fonts-style display-2"></span>
                </div>
                <div class="mbr-section-btn pt-3"><a href="get-started.php" class="btn btn-primary display-4">Get Started!</a></div>
            </div>
        </div>
    </div>
</section>

<section class="features6 cid-s5umfG9hL8" id="virtual-shop">
    <div class="container">
        <div class="d-flex card-wrapper">
            <div class="image-wrapper">
                <img src="assets/images/online-shop-1108x1036.jpg" alt="Online Store" title="">
            </div>
            <div class="text-box">
                <h5 class="mbr-title mbr-fonts-style display-2">
                    <strong>Virtual Shop</strong></h5>
                <p class="mbr-text mbr-fonts-style display-7">Put your products online for your customers to see and buy from you wherever they are. With easy to manage dashboard and mobile friendly templates, you can setup your virtual shop in minutes.</p>
                <div class="cost">
                    <span class="currentcost mbr-fonts-style pr-2 display-2">N5,000/yr</span>
                    <span class="oldcost mbr-fonts-style display-2"></span>
                </div>
                <div class="mbr-section-btn pt-3"><a href="get-started.php" class="btn btn-primary display-4">Get Started!</a></div>
            </div>
        </div>
    </div>
</section>

<section class="features5 cid-s5vnjw1YWV" id="features5-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-12 col-lg-6">
                <div class="card-wrapper mbr-flex">
                    <div class="card-box align-left">
                        <h5 class="card-title mbr-fonts-style align-left mb-3 display-5">
                            <strong>Direct Whatsapp Messaging</strong></h5>
                        <p class="mbr-text mbr-fonts-style mb-3 display-4">
                            Allows customers chat you up on whatsapp</p>                        
                    </div>
                    <div class="img-wrapper img1 align-center">
                        <span class="mbr-iconfont socicon-whatsapp socicon"></span>
                    </div>
                </div>
            </div>

            <div class="card col-12 col-lg-6">
                <div class="card-wrapper mbr-flex">
                    <div class="card-box align-left">
                        
                        <h5 class="card-title mbr-fonts-style align-left mb-3 display-5">
                            <strong>Easy to Setup and Manage</strong></h5>
                        <p class="mbr-text mbr-fonts-style mb-3 display-4">
                            Just like creating a social media account, setting up and managing your eOffice is very easy.</p>
                        
                    </div>
                    <div class="img-wrapper img2 align-center">
                        <span class="mbr-iconfont mbrib-like"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features12 cid-s5vqlDeeth" id="features12-6">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong>Why you need an eOffice!</strong></h4>
                        <p class="mbr-text mbr-fonts-style mb-4 display-7">
                            Just as you need a physical office so people in your locality can see and contact you, same way you need an eOffice so people anywhere can see what you do and contact you.</p>
                        <div class="mbr-section-btn"><a class="btn btn-primary display-4" href="get-started.php">Get Started!</a></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont socicon-google socicon"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7">
                            <strong>Be Found On Google</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">eOffice gives your business an opportunity to be found on Google or other search engines, not just on social media.</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mobi-mbri-image-slider mobi-mbri"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7">
                            <strong>Share Your Portfolio</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">eOffice makes it possible to share your portfolio with prospective customers who can't make it to your physical office. Just send your eOffice address.</h5>
                    </div>
                </div>
                <div class="item mbr-flex">
                    <div class="icon-box">
                        <span class="mbr-iconfont mobi-mbri-growing-chart mobi-mbri"></span>
                    </div>
                    <div class="text-box">
                        <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7">
                            <strong>Sell More</strong></h4>
                        <h5 class="icon-text mbr-black mbr-fonts-style display-4">Research shows that currently more trade happens online than offiline. eOffice gives you a chance to reach more people and make more sales.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




    <?php 
        include 'includes/footer.php'; 
        include 'includes/js-include.php';
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