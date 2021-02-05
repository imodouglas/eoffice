<?php
  include '../classes/includes.php';
  include 'content/restriction.php';
  include 'content/add-product.php';

  if(isset($_GET['product'], $_GET['cmd']) && $_GET['cmd'] == "delete"){
    $delProd = $conn->prepare("DELETE FROM products WHERE productID = ?");
    $delProd->execute(array($_GET['product']));
    if($delProd){ echo "<script> alert('Product deleted!'); window.location = 'products.php'; </script>"; }
  }
?>
<!DOCTYPE html>
<html>
  <title>Products | Crystal Glow Skin Care </title>
  <?php include 'tags/header.php'; ?>

  <body>
    <?php include 'tags/menu.php'; ?>

    <section class="header3  mbr-fullscreen" style="padding-top:100px" id="header3-1">
        <div class="container">
          <div class="row">
            <div class="col-sm-9">
              <div class="item-container">
                <div class="item-header">
                  PRODUCTS
                </div>
                <div style="border-top:#333 thin solid; padding:10px">

                  <?php
                    if(isset($_GET['product']) && !isset($_GET['cmd'])){
                      include 'content/product-edit.php';
                    } else {
                      include 'content/show-products.php';
                    }
                  ?>

                </div>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="item-container">
                <div class="item-header">
                  ADD PRODUCT
                </div>
                <div style="border-top:#333 thin solid; padding:10px">
                  <form method="post" enctype="multipart/form-data" action="">
                    <p>
                      Select Category:
                      <select name="catID" class="form-control">
                        <?php foreach($getCategories AS $categories){ ?>
                          <option value="<?php echo $categories['catID']; ?>"> <?php echo $categories['catName']; ?> </option>
                         <?php } ?>
                      </select>
                    </p>
                    <p>
                      Enter Product Name:
                      <input type="text" name="productName" class="form-control">
                    </p>
                    <p>
                      Enter Product Price:
                      <input type="number" name="productPrice" class="form-control">
                    </p>
                    <p>
                      Upload Product Image:
                      <input size="25" name="file" type="file" class="form-control" />
                    </p>
                    <p>
                      Product Status:
                      <select name="productStatus" class="form-control">
                        <option value="In Stock"> In Stock </option>
                        <option value="Out of Stock"> Out of Stock </option>
                      </select>
                    </p>
                    <input type="submit" name="addProd" class="btn btn-black form-control" style="padding: 5px 5px 5px 5px" value="Add" />
                  </form>
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
