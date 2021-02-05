<?php
  $getproductsq = $conn->prepare("SELECT * FROM products WHERE productID = ?");
  $getproductsq->execute(array($_GET['product']));
  $getproductsct = $getproductsq->rowCount();
  $getproducts = $getproductsq->fetchAll();
  foreach($getproducts AS $products){
?>
  <form method="post" enctype="multipart/form-data" action="">
    <p>
      <input type="hidden" name="productID" value="<?php echo $products['productID']; ?>">
    </p>
    <!-- <p>
      Product Category:
      <select name="catID" class="form-control">
        <?php foreach($getCategories AS $categories){ if($categories['catID'] == $products['catID']){ $pactive = "selected"; } else{ $pactive = ""; } ?>
          <option value="<?php echo $categories['catID']; ?>" <?php echo $pactive; ?>> <?php echo $categories['catName']; ?> </option>
         <?php } ?>
      </select>
    </p> -->
    <p>
      Product Name:
      <input type="text" name="productName" value="<?php echo $products['productName']; ?>" class="form-control">
    </p>
    <p>
      Product Description:
      <textarea name="productDesc" class="form-control" style="height:100px"><?php echo $products['productDesc']; ?></textarea>
    </p>
    <p>
      Product Price:
      <input type="text" name="productPrice" value="<?php echo $products['productPrice']; ?>" class="form-control">
    </p>
    <p>
      Product Image:
      <input type="file" name="file" class="form-control">
    </p>
    <p>
      Product Status:
      <select name="productStatus" class="form-control">
        <option value="In Stock" <?php if($products['productStatus'] == "In Stock"){ echo "selected"; } ?>> In Stock </option>
        <option value="Out of Stock" <?php if($products['productStatus'] == "Out of Stock"){ echo "selected"; } ?>> Out of Stock </option>
      </select>
    </p>
    <p>
      <input type="submit" name="upProd" class="btn btn-primary"  value="Update" />
    </p>
  </form>
<?php } ?>
