<section class="services1 cid-s6DzvBJVM5" id="products">
    
    <!--Container-->
    <div class="container">
        <div class="row justify-content-center">
            <!--Titles-->
            <div class="title pb-5 col-12">
                <h2 class="align-left pb-3 mbr-fonts-style display-2">
                    Our Products</h2>
                
            </div>

            <?php 
                foreach(oProducts($conn, $siteData['officeID']) AS $product){ 
                    $wtext1 = explode("[product-name]", $siteData['defText']);
                    $wtext2 = implode($product['productName'],$wtext1);
                    $href = "https://api.whatsapp.com/send?phone=".$siteData['phoneNo']."&text=".$wtext2;
            ?>
                <!--Card-1-->
                <div class="card col-12 col-md-4 col-sm-6 p-3 col-lg-3">
                    <div class="card-wrapper">
                        <div class="card-img">
                            <img src="<?php echo $siteData['siteURL']."/".$product['productPhoto']; ?>" alt="<?php echo $product['productName']; ?>">
                        </div>
                        <div class="card-box">
                            <h4 class="card-title mbr-fonts-style display-5">
                                <?php echo $product['productName']; ?>
                            </h4>
                            <p class="mbr-text mbr-fonts-style display-7" style="padding-top:0">
                                <?php echo $product['productDesc']; ?>
                            </p>
                            <p> <?php if($siteData['showPrices'] == "yes"){ echo "<h3 align='center'> N".number_format($product['productPrice'],0)." </h3>"; } ?> </p>
                            <!--Btn-->
                            <div class="mbr-section-btn align-left" style="padding-top:0">
                                <a href="<?php echo $href; ?>" class="btn btn-black-outline display-4">Chat to Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            
        </div>
    </div>
</section>