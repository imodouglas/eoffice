<section class="features12 cid-s9IiZcg8B3" id="achievements">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6" style="background:#ffe161; padding: 20px">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2" align="center">
                            <strong><?php echo $siteData['experienceTitle']; ?></strong>
                        </h4>
                        
                    </div>
                </div>
                <?php foreach(oAcmtType($conn,$siteData['officeID'],"Experience") AS $expr){ ?>
                    <div class="item mbr-flex">
                        <div class="icon-box" style="background:none">
                            <span class="mbr-iconfont fas fa-caret-right"></span>
                        </div>
                        <div class="text-box">
                            <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7">
                                <strong><?php echo $expr['acmtCompany'].", ".$expr['acmtLocation']. "(".$expr['acmtStart']."-".$expr['acmtEnd'].")"; ?></strong></h4>
                            <h5 class="icon-text mbr-black mbr-fonts-style display-4"><?php echo "<b>".$expr['acmtPosition'].": </b> ".$expr['acmtDesc']; ?></h5>
                        </div>
                    </div>
                <?php } ?>
                
            </div>
            <div class="col-12 col-lg-6" style="background:#f0f0f0; padding: 20px">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title mbr-fonts-style mb-4 display-2" align="center"><strong><?php echo $siteData['expertiseTitle']; ?></strong></h4>
                    </div>
                </div>
                <?php foreach(oAcmtType($conn,$siteData['officeID'],"Expertise") AS $expt){ ?>
                    <div class="item mbr-flex">
                        <div class="icon-box" style="background:none">
                            <span class="mbr-iconfont fas fa-caret-right"></span>
                        </div>
                        <div class="text-box">
                            <h4 class="icon-title mbr-semibold mbr-black mbr-fonts-style display-7">
                                <strong><?php echo $expt['acmtCompany']; ?></strong></h4>
                            <h5 class="icon-text mbr-black mbr-fonts-style display-4"><?php echo $expt['acmtDesc']; ?></h5>
                        </div>
                    </div>
                <?php } ?>
            
            </div>
        </div>
    </div>
</section>