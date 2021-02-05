<section class="mbr-section content4 cid-s9I7IVTejq" id="our-services">

    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2">
                    <?php echo $siteData['servicesTitle']; ?>
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light mbr-fonts-style display-5">
                    <?php echo $siteData['servicesSubTitle']; ?>
                </h3>
            </div>
        </div>
    </div>
</section>

<section class="features3 cid-s9I7bo1RCR" id="services">

    <div class="container">
        <div class="media-container-row">
            <?php foreach (getServices($conn, $siteData['officeID']) AS $serv){ $sImage = $siteData['siteURL']."/".$serv['serviceImage']; ?>
                <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <div class="card-wrapper">
                        <?php if($sImage !== ""){ ?>
                            <div class="card-img">
                                <img src="<?php echo $sImage; ?>" alt="eOffice NG">
                            </div>
                        <?php } ?>
                        <div class="card-box">
                            <h4 class="card-title mbr-fonts-style display-7" style="text-align:center">
                                <?php echo $serv['serviceName']; ?>
                            </h4>
                            <p class="mbr-text mbr-fonts-style display-7" style="text-align:center">
                                <?php echo $serv['serviceDesc']; ?>
                            </p>
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a href="https://wa.me/<?php echo $siteData['phoneNo']; ?>" class="btn btn-primary display-4">Request</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

            
            
        </div>
    </div>
</section>