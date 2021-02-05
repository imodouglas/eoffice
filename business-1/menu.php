    <section class="menu cid-s9I9tlfOkV" once="menu" id="menu1-8">
        <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="menu-logo">
                <div class="navbar-brand">
                    <?php if($siteData['officeLogo'] !== ""){ ?>                    
                        <span class="navbar-logo">
                            <a href="./">
                                <img src="<?php echo $siteData['siteURL']."/".$siteData['officeLogo']; ?>" alt="eOffice NG" title="" style="height: 3.8rem;">
                            </a>
                        </span>
                    <?php } ?>
                    <span class="navbar-caption-wrap">
                        <a class="navbar-caption text-white display-4" href="./">
                            <?php echo strtoupper($siteData['officeName']); ?>
                        </a>
                    </span>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="#about-us"><?php echo $siteData['aboutTitle']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="#our-services"><?php echo $siteData['servicesTitle']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="#gallery"><?php echo $siteData['galleryTitle']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-white display-4" href="#contact-us"><?php echo $siteData['contactusTitle']; ?></a>
                    </li>
                </ul>
                
                <div class="navbar-buttons mbr-section-btn">
                    <a class="btn btn-sm btn-primary display-4" href="https://wa.me/<?php echo $siteData['phoneNo']; ?>">
                        <span class="fab fa-whatsapp mbr-iconfont mbr-iconfont-btn"></span>
                        Chat With Us
                    </a>
                </div>
            </div>
        </nav>
    </section>