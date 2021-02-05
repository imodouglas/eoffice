<section class="features11 cid-s9Ih9ISbwT" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 md-pb m-auto">
                <img src="<?php echo $siteData['siteURL'].'/'.$siteData['aboutImg']; ?>" alt="<?php echo $siteData['officeName']; ?>" title="">
            </div>
            <div class="col-12 col-lg-6 m-auto" style="padding-top:20px">
                <div class="card-wrapper">
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2">
                            <strong><?php echo $siteData['aboutTitle']; ?></strong>
                        </h4>
                        <div class="mbr-text mbr-fonts-style counter-container display-7">
                            <?php echo nl2br($siteData['aboutText']); ?>
                        </div>
                        <div class="mbr-section-btn mb-4">
                            <a class="btn btn-primary display-4" href="#contact-me">Contact Me</a>
                            <a class="btn btn-primary display-4" href="https://wa.me/?phone=<?php echo $siteData['phoneNo']; ?>"><i class='fab fa-whatsapp'></i> &nbsp;Chat With Me </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>