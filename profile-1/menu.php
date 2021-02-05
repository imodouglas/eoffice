<section class="menu cid-s9IgPbGFyD" once="menu" id="menu3-0">
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <?php if($siteData['officeLogo'] !== ""){ ?>                    
                    <span class="navbar-logo">
                        <a href="./">
                            <img src="<?php echo $siteData['siteURL']."/".$siteData['officeLogo']; ?>" alt="eOffice NG" title="" style="height: 3.8rem;">
                        </a>
                    </span>
                <?php } ?>
                <span class="navbar-caption-wrap">
                    <a class="navbar-caption text-black display-7" href="./"><?php echo strtoupper($siteData['officeName']); ?></a>
                </span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="#about">About Me</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="#portfolio"><?php echo $siteData['portfolioTitle']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="#achievements">My Achievements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link text-black display-4" href="#contact-me">Contact Me</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
</section>