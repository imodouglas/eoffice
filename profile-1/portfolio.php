<section class="features4 cid-sgCg2UKgWm" style="background:#f0f0f0" id="portfolio">
    
    <div class="mbr-overlay"></div>
    <div class="container">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong><?php echo $siteData['portfolioTitle']; ?></strong></h4>
            
        </div>
        <div class="row mt-4">
            <?php foreach(oPortfolio($conn,$siteData['officeID']) AS $portfolio ){ ?>
                <div class="item features-image сol-12 col-md-6 col-lg-4">
                    <div class="item-wrapper" style="box-shadow: #ccc 2px 2px 4px">
                        <div class="item-img">
                            <?php if($portfolio['portfolioImg'] !== ""){ if($portfolio['postType'] == "image") { ?>
                                <img src="<?php echo $siteData['siteURL']."/".$portfolio['portfolioImg']; ?>" style="width:100% !important" />
                            <?php } else if($portfolio['postType'] == "video") {?>
                                <iframe style="width:100%; min-height:300px" src="<?php echo cleanVURL($portfolio['portfolioImg']); ?>" frameborder="0" allowfullscreen></iframe>
                            <?php } } ?>
                        </div>
                        <div class="item-content">
                            <h5 class="item-title mbr-fonts-style display-5"><strong><?php echo $portfolio['portfolioName']; ?></strong></h5>
                            
                            <p class="mbr-text mbr-fonts-style mt-3 display-7"><?php echo $portfolio['portfolioText']; ?></p>
                        </div>
                        <div class="mbr-section-btn item-footer mt-2"><a href="<?php echo cleanURL($portfolio['portfolioLink']); ?>" class="btn item-btn btn-black display-7" target="_blank"><?php echo $portfolio['portfolioBtn']; ?></a></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>