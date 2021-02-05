<?php
  include '../classes/includes.php';
  include 'content/restriction.php';
?>
<!DOCTYPE html>
<html>
  <title>Admin Home | Crystal Glow Skin Care </title>
  <?php include 'tags/header.php'; ?>

  <body>
    <?php include 'tags/menu.php'; ?>

    <section class="header3  mbr-fullscreen" style="padding-top:100px" id="header3-1">
        <div class="container" align="center">
          <div class="row">
            <div class="col-sm-4">
              <div class="item-container" align="center">
                <div class="item-header" align="center">
                  CATEGORIES
                </div>
                <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo $getCategoriesct; ?></php> </h1>
                <div style="border-top:#333 thin solid; padding:5px">
                  <a href="categories.php"> Add/Edit/Remove </a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="item-container">
                <div class="item-header" align="center">
                  PRODUCTS
                </div>
                <h1 style="padding-top:15px; padding-bottom:15px"> <?php echo $getproductsct; ?></php> </h1>
                <div style="border-top:#333 thin solid; padding:5px">
                  <a href="products.php"> Add/Edit/Remove </a>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="item-container">
                <div class="item-header" align="center">
                  OPTIONS
                </div>
                <h1 style="padding-top:15px; padding-bottom:15px"> 3 </php> </h1>
                <div style="border-top:#333 thin solid; padding:5px">
                  <a href="options.php">Edit Options</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>


    <?php include 'tags/footer.php'; ?>


    <?php include 'tags/scripts.js' ?>


  </body>

</html>
