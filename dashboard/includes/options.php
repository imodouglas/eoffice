<?php
  include '../classes/includes.php';
  include 'content/restriction.php';
?>
<!DOCTYPE html>
<html>
  <title>Categories | Crystal Glow Skin Care </title>
  <?php include 'tags/header.php'; ?>

  <body>
    <?php include 'tags/menu.php'; ?>

    <section class="header3  mbr-fullscreen" style="padding-top:100px" id="header3-1">
        <div class="container">
          <div class="row">
            <div class="col-sm-8">
              <div class="item-container">
                <div class="item-header">
                  OPTIONS
                </div>
                <div style="border-top:#333 thin solid; padding:5px">
                  <form method="post" action="">
                    <div style="padding:10px">
                      Whatsapp Phone No.(e.g 2348012345678):
                      <input type="number" name="phone" class="form-control" value="<?php if($Options['phoneNo'] == ""){ echo "234"; } else { echo $Options['phoneNo']; } ?>" />
                    </div>
                    <div style="padding:10px">
                      Whatsapp Message: <br /><span style="font-size:12px; color:red"> [product-name] displays the product name </span>
                      <input type="text" name="whatsapp" class="form-control" value="<?php echo $Options['defText']; ?>" />
                    </div>
                    <div style="padding:10px">
                      Show Prices:
                      <select name="showPrice" class="form-control">
                        <option value="yes" <?php if($Options['showPrices'] == "yes"){ echo "selected"; } ?> > Yes </option>
                        <option value="no" <?php if($Options['showPrices'] == "no"){ echo "selected"; } ?>> No </option>
                      </select>
                    </div>
                    <input type="submit" name="editOption" class="btn btn-black form-control" style="padding: 2px 2px 2px 2px" value="Update" />
                  </form>
                </div>
              </div>
            </div>

            <div class="col-sm-4">

            </div>
          </div>
        </div>
    </section>


    <?php include 'tags/footer.php'; ?>


    <?php include 'tags/scripts.js' ?>


  </body>

</html>
