<?php 
    if($siteData['headerBG'] !== ""){ $hbg = $siteData['siteURL']."/".$siteData['headerBG']; }
    else { $hgb = $hbg = $siteData['siteURL']."/".$siteData['templateDir']."/assets/images/header.jpg"; }
?>
<section class="cid-s9I6Wms0Z9 mbr-fullscreen mbr-parallax-background" id="home" style="background: url('<?php echo $hbg; ?>'); background-size:cover; background-position:center center">

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1"><?php echo $siteData['headTitle']; ?></h1>
                
                <p class="mbr-text pb-3 mbr-fonts-style display-5"> <?php echo $siteData['headSubTitle']; ?> </p>
                <div class="mbr-section-btn">
                    <a class="btn btn-md btn-primary display-4" href="#about-us"><?php echo $siteData['headButton1']; ?></a>
                    <a class="btn btn-md btn-white-outline display-4" href="#contact-us"><?php echo $siteData['headButton2']; ?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="mbr-arrow hidden-sm-down" aria-hidden="true">
        <a href="#next">
            <i class="fas fa-arrow-down mbr-iconfont"></i>
        </a>
    </div>
</section>