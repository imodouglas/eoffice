<section class="contacts1 cid-s9IiiKFruT" id="contact-me">
    <div class="container">
        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
            <strong><?php echo $siteData['contactTitle']; ?></strong></h3>
        <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-5 display-5">
            <?php echo $siteData['contactSubTitle']; ?>
        </h4>
        <div class="row justify-content-center">
            <div class="card col-12 col-lg-6">
                <div class="card-wrapper" style="box-shadow:#ccc 3px 3px 4px">
                    <div class="card-box align-center">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont fas fa-envelope"></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style mb-2 display-2">
                            <strong>Email</strong>
                        </h4>
                        <h5 class="link mbr-fonts-style display-7">
                            <a href="mailto:<?php echo $siteData['contactEmail']; ?>" class="text-primary"><?php echo $siteData['contactEmail']; ?></a>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card col-12 col-lg-6">
                <div class="card-wrapper" style="box-shadow:#ccc 3px 3px 4px">
                    <div class="card-box align-center">
                        <div class="image-wrapper">
                            <span class="mbr-iconfont fas fa-mobile-alt"></span>
                        </div>
                        <h4 class="card-title mbr-fonts-style align-center mb-2 display-2">
                            <strong>Phone</strong>
                        </h4>
                        <h5 class="link mbr-bold mbr-black mbr-fonts-style display-7">
                            <a href="tel:<?php echo $siteData['contactPhone']; ?>" class="text-primary"><?php echo $siteData['contactPhone']; ?></a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
