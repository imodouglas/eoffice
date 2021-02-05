<section class="footer3 cid-s9IinyursY" once="footers" id="footer3-8">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">
                <li class="foot-menu-item mbr-fonts-style display-7">Home</li><li class="foot-menu-item mbr-fonts-style display-7">Personal Data</li><li class="foot-menu-item mbr-fonts-style display-7">Contact Me</li></ul>
            </div>
            <div class="row social-row">
                <div class="social-list align-right pb-2">
                    <?php if($siteData['twitter'] !== ""){ ?>
                        <div class="soc-item">
                            <a href="<?php echo cleanURL($siteData['twitter']); ?>" target="_blank">
                                <span class="fab fa-twitter mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($siteData['facebook'] !== ""){ ?>
                        <div class="soc-item">
                            <a href="<?php echo cleanURL($siteData['facebook']); ?>" target="_blank">
                                <span class="fab fa-facebook mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($siteData['instagram'] !== ""){ ?>
                        <div class="soc-item">
                            <a href="<?php echo cleanURL($siteData['instagram']); ?>" target="_blank">
                                <span class="fab fa-instagram mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($siteData['linkedin'] !== ""){ ?>
                        <div class="soc-item">
                            <a href="<?php echo cleanURL($siteData['linkedin']); ?>" target="_blank">
                                <span class="mbr-iconfont mbr-iconfont-social fab fa-linkedin"></span>
                            </a>
                        </div>
                    <?php } ?>
                    <?php if($siteData['youtube'] !== ""){ ?>
                        <div class="soc-item">
                            <a href="<?php echo cleanURL($siteData['youtube']); ?>" target="_blank">
                                <span class="fab fa-youtube mbr-iconfont mbr-iconfont-social"></span>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7"><?php echo $siteData['officeName']; ?> © Copyright <?php echo date("Y"); ?><br>Powered by <a href="https://eoffice.com.ng" target="_blank">eOffice NG</a> - All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</section>

<section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: none;">
    <p style="flex: 0 0 auto; margin:0; padding-right:1rem;"><a href="https://mobirise.site/" style="color:#aaa;"></a> </p>
</section>