<div id="pageLoading">
    <div class="eo-center eo-dark-bg w100" style="position:fixed; height:100vh; z-index:3000"></div>
    <div class="eo-center" style="position:fixed; max-width:100px;  z-index:3100">
        <img src="<?php echo $siteURL."/assets/images/loading.gif"; ?>" style="width:100px" />
    </div>
</div>


<section class="menu cid-s5u3Vs2gBs" once="menu" id="menu2-0">
    
    <nav class="navbar navbar-dropdown navbar-fixed-top navbar-expand-lg">
        <div class="container">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="../">
                        <img src="../assets/images/logo-only-430x326.png" alt="eOffice NG" title="" style="height: 3.8rem;">
                    </a>
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
                <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true"><li class="nav-item"><a class="nav-link link text-black display-4" href="#">
                            About us</a></li>
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="#">
                            Services</a></li>
                    <li class="nav-item"><a class="nav-link link text-black display-4" href="#">Contacts</a>
                    </li></ul>
                
                <div class="navbar-buttons mbr-section-btn">
                    <?php if(!isset($_SESSION['eo_user_session'])){ ?><a class="btn btn-primary display-4" href="#">Get Started!</a> <?php } else { ?>
                        <a class="btn btn-primary display-4" href="logout.php">Logout</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

</section>