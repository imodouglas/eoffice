<section class="mbr-section content4 cid-s9I7iJbgKU" id="gallery">
    <div class="container">
        <div class="media-container-row">
            <div class="title col-12 col-md-8">
                <h2 class="align-center pb-3 mbr-fonts-style display-2"><?php echo $siteData['galleryTitle'] ?></h2>
            </div>
        </div>
    </div>
</section>

<section class="mbr-gallery mbr-slider-carousel cid-s9I7eTl18f" id="gallery3-3">
    <div>
        <div>
            <div class="mbr-gallery-row">
                <div class="mbr-gallery-layout-default">
                    <div>
                        <div>
                            <?php $i = -1; foreach (getGallery($conn, $siteData['officeID']) AS $gal){ $i = $i+1; $gimage = $siteData['siteURL']."/".$gal['gImage']; ?>
                                <div class="mbr-gallery-item mbr-gallery-item--p0" data-video-url="false" data-tags="Awesome">
                                    <div href="#lb-gallery3-3" data-slide-to="<?php echo $i; ?>" data-toggle="modal">
                                        <img src="<?php echo $gimage; ?>" alt="<?php echo $siteData['officeName']; ?>" title="">
                                        <!-- <span class="icon-focus"><i class="fas fa-search"></i></span> -->
                                        <i class="fas fa-search" style="position: absolute; top: calc(50% - 32px); left: calc(50% - 24px); color: rgb(255, 255, 255); opacity: 0; transition: opacity 0.2s ease-in-out 0s; z-index: 5; font-size: 3rem !important;"></i>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <!-- Lightbox -->
            <div data-app-prevent-settings="" class="mbr-slider modal fade carousel slide" tabindex="-1" data-keyboard="true" data-interval="false" id="lb-gallery3-3">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="carousel-inner">
                                <?php $a = -1; foreach (getGallery($conn, $siteData['officeID']) AS $gal){ $a = $a+1; $gimage = $siteData['siteURL']."/".$gal['gImage']; ?>
                                    <div class="carousel-item <?php if($a == 1){ echo 'active'; } ?>">
                                        <img src="<?php echo $gimage; ?>" alt="<?php echo $siteData['officeName']; ?>" title="">
                                    </div>
                                <?php } ?>
                            </div>
                            
                            <a class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#lb-gallery3-3">
                                <i class="fas fa-arrow-left mbr-iconfont" aria-hidden="true"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control carousel-control-next" role="button" data-slide="next" href="#lb-gallery3-3">
                                <i class="fas fa-arrow-right mbr-iconfont" aria-hidden="true"></i>
                                <span class="sr-only">Next</span>
                            </a>
                            <a class="close" href="#" role="button" data-dismiss="modal" style="font-family:arial !important">
                                <i class="fas fa-times mbr-iconfont" aria-hidden="true"></i>
                                <!-- <span class="sr-only">Close</span> -->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>