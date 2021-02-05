<section class="header2 cid-s9IgVd90kl mbr-fullscreen" id="home" style="background: url('<?php echo $siteData['siteURL'].'/'.$siteData['headerBG']; ?>'); background-size:cover; background-position:center">
    <div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(0, 0, 0);"></div>

    <div class="align-center container">
        <div class="row justify-content-end">
            <div class="col-12 col-lg-7">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong><?php echo $siteData['headTitle']; ?></strong></h1>
                
                <p class="mbr-text mbr-fonts-style display-7">
                    <?php echo $siteData['headSubTitle']; ?>
                </p>
                <div align="right">
                    <?php if($siteData['twitter'] !== ""){ ?>
                        <a href="<?php echo cleanURL($siteData['twitter']); ?>" target="_blank" style="font-size:32px; color:#ffe161"> <span class="fab fa-twitter"></span> </a>
                    <?php } ?>
                    <?php if($siteData['facebook'] !== ""){ ?>
                        <a href="<?php echo cleanURL($siteData['facebook']); ?>" target="_blank" style="font-size:32px; color:#ffe161"> <span class="fab fa-facebook"></span> </a>
                    <?php } ?>
                    <?php if($siteData['instagram'] !== ""){ ?>
                        <a href="<?php echo cleanURL($siteData['instagram']); ?>" target="_blank" style="font-size:32px; color:#ffe161"> <span class="fab fa-instagram"></span> </a>
                    <?php } ?>
                    <?php if($siteData['linkedin'] !== ""){ ?>
                        <a href="<?php echo cleanURL($siteData['linkedin']); ?>" target="_blank" style="font-size:32px; color:#ffe161"> <span class="fab fa-linkedin"></span> </a>
                    <?php } ?>
                    <?php if($siteData['youtube'] !== ""){ ?>
                        <a href="<?php echo cleanURL($siteData['youtube']); ?>" target="_blank" style="font-size:32px; color:#ffe161"> <span class="fab fa-youtube"></span></a>
                    <?php } ?>
                </div>
                <div class="mbr-section-btn mt-3">
                    <a class="btn btn-warning display-7" href="#contact-me"><?php echo $siteData['headBtn1']; ?></a>
                    <a class="btn btn-white display-7" href="#portfolio"><?php echo $siteData['headBtn2']; ?></a>
                </div>
            </div>
        </div>
    </div>
</section>