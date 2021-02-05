<div class="row">
  <?php
    foreach(oProducts($conn,$officeID) AS $products){
  ?>
    <div class="col-sm-4" align="center" style="margin-bottom:10px">
      <div style="border:#333 thin solid">
        <img src="../<?php echo $products['productPhoto']; ?>" style="width:100% !important" />
        <div class="p10">
          <p> <strong> <?php echo $products['productName']; ?> </strong> <p>
          <p> <?php echo $products['productDesc']; ?> </p>
          <h3> <?php echo "N".number_format($products['productPrice']); ?> </h3>
          <div style="border-top:#333 thin solid" class="p5">
            <a href="?id=<?php echo $officeID; ?>&product=<?php echo $products['productID']; ?>" class="btn btn-primary" style="padding: 2px 10px"> Edit </a>
            <!-- <a href="?id=<?php echo $officeID; ?>&product=<?php echo $products['productID']; ?>&cmd=delete" class="btn btn-primary" style="padding: 2px 2px 2px 2px"> Delete </a> -->
            <a href="#" onclick="doDelete(<?php echo $officeID; ?>, <?php echo $products['productID']; ?>)" class="btn btn-danger" style="padding: 2px 10px"> Delete </a>    
          </div>
        </div>
      </div>
    </div>

  <?php } ?>
</div>