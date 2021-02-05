<div class="row" style="margin-bottom:20px;">
    <div class="col-12">
        <div style="background:#333; color:#fff; padding:10px"> HEADER/WELCOME SECTION </div>
        <div style="padding:10px; border:#333 thin solid;">
            <p>
                <label> Header Title </label>
                <input type="text" name="headTitle" class="form-control" value="<?php echo $siteData['headTitle']; ?>" />
            </p>
            <p>
                <label> Header Subtitle </label>
                <input type="text" name="headSubtitle" class="form-control" value="<?php echo $siteData['headSubTitle']; ?>" />
            </p>
            <p>
                <label> Header Background Image </label>
                <input name="file" type="file" class="form-control" />
            </p>
            <p>
                <label> Contact Button </label>
                <input type="text" name="headBtn1" class="form-control" value="<?php echo $siteData['headBtn1']; ?>" />
            </p>
            <p>
                <label> Portfolio Button </label>
                <input type="text" name="headBtn2" class="form-control" value="<?php echo $siteData['headBtn2']; ?>" />
            </p>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom:20px;">
    <div class="col-12">
        <div style="background:#333; color:#fff; padding:20px"> ABOUT US SECTION </div>
        <div style="padding:10px; border:#333 thin solid;">
            <p>
                <label> About Image Image </label>
                <input name="aboutImg" type="file" class="form-control" />
            </p>
            <p>
                <label> Short Brief About You. </label>
                <textarea name="summary" class="form-control" style="height:100px"><?php echo $siteData['summary']; ?></textarea>
            </p>
            <p>
                <label> About Title </label>
                <input type="text" name="aboutTitle" class="form-control" value="<?php echo $siteData['aboutTitle']; ?>" />
            </p>
            <p>
                <label> About Text </label>
                <textarea name="aboutText" class="form-control"><?php echo $siteData['aboutText']; ?></textarea>
            </p>
            <p>
                <label> Contact Button </label>
                <input type="text" name="aboutBtn1" class="form-control" value="<?php echo $siteData['aboutBtn1']; ?>" />
            </p>
            <p>
                <label> Chat Me Button </label>
                <input type="text" name="aboutBtn2" class="form-control" value="<?php echo $siteData['aboutBtn2']; ?>" />
            </p>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom:20px;">
    <div class="col-12">
        <div style="background:#333; color:#fff; padding:20px"> PORTFOLIO / ACHIEVEMENTS SECTION </div>
        <div style="padding:10px; border:#333 thin solid;">
            <p>
                <label> Portfolio Title </label>
                <input type="text" name="portfolioTitle" class="form-control" value="<?php echo $siteData['portfolioTitle']; ?>" />
            </p>
            <p>
                <label> Experience Title </label>
                <input type="text" name="experienceTitle" class="form-control" value="<?php echo $siteData['experienceTitle']; ?>" />
            </p>
            <p>
                <label> Expertise Title </label>
                <input type="text" name="expertiseTitle" class="form-control" value="<?php echo $siteData['expertiseTitle']; ?>" />
            </p>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom:20px;">
    <div class="col-12">
        <div style="background:#333; color:#fff; padding:20px"> CONTACT SECTION </div>
        <div style="padding:10px; border:#333 thin solid;">
            <p>
                <label> Contact Title </label>
                <input type="text" name="contactTitle" class="form-control" value="<?php echo $siteData['contactTitle']; ?>" />
            </p>
            <p>
                <label> Contact Subtitle </label>
                <input type="text" name="contactSubTitle" class="form-control" value="<?php echo $siteData['contactSubTitle']; ?>" />
            </p>
            <p>
                <label> Email </label>
                <input type="email" name="contactEmail" class="form-control" value="<?php echo $siteData['contactEmail']; ?>" />
            </p>
            <p>
                <label> Phone No. </label>
                <input type="text" name="contactPhone" class="form-control" value="<?php echo $siteData['contactPhone']; ?>" />
            </p>
        </div>
    </div>
</div>