<section once="footers" class="cid-s9I7AX2ei5" id="footer7-6">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">    
                    <li class="foot-menu-item mbr-fonts-style display-7"><a href="#">Home</a></li>
                    <li class="foot-menu-item mbr-fonts-style display-7"><a href="#about-us"><?php echo $siteData['aboutTitle']; ?></a></li>
                    <li class="foot-menu-item mbr-fonts-style display-7"><a href="#our-services"><?php echo $siteData['servicesTitle']; ?></a></li>
                    <li class="foot-menu-item mbr-fonts-style display-7"><a href="#gallery"><?php echo $siteData['galleryTitle']; ?></a></li>
                    <li class="foot-menu-item mbr-fonts-style display-7"><a href="#contact-us"><?php echo $siteData['contactusTitle']; ?></a></li>
                </ul>
            </div>
            <div class="row social-row">
                <div class="social-list align-right pb-2">
                    <div class="soc-item">
                        <a href="<?php echo cleanURL($siteData['socialFacebook']); ?>" target="_blank">
                            <i class="fab fa-facebook mbr-iconfont mbr-iconfont-social"></i>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="<?php echo cleanURL($siteData['socialInstagram']); ?>" target="_blank">
                            <i class="fab fa-instagram mbr-iconfont mbr-iconfont-social"></i>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="<?php echo cleanURL($siteData['socialTwitter']); ?>" target="_blank">
                            <i class="fab fa-twitter mbr-iconfont mbr-iconfont-social"></i>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="<?php echo cleanURL($siteData['socialLinkedin']); ?>" target="_blank">
                            <span class="fab fa-linkedin mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7"><?php echo $siteData['officeName']; ?> © <?php echo date("Y"); ?> - All Rights Reserved<br>Powered by <a href="https://eoffice.com.ng" target="_blank">eOffice NG</a></p>
            </div>
        </div>
    </div>
</section>