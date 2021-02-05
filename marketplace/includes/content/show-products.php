<table style="width:100%">
  <tr>
    <!-- <th style="padding:10px; width:40%;"> Category </th> -->
    <th style="padding:10px; width:40%;"> Product Name </th>
    <th style="padding:10px; width:20%;"> Action </th>
  </tr>
  <?php
    foreach(oProducts($conn,$officeID) AS $products){
  ?>
    <tr style="border-bottom:#999 thin solid">
      <!-- <td style="padding:10px;">
        <?php echo $products['catName']; ?>
      </td> -->
      <td style="padding:10px;">
        <?php echo $products['productName']; ?>
      </td>
      <td style="padding:10px;">
        <a href="?id=<?php echo $officeID; ?>&product=<?php echo $products['productID']; ?>" class="btn btn-black" style="padding: 2px 2px 2px 2px"> Edit </a>
        <!-- <a href="?id=<?php echo $officeID; ?>&product=<?php echo $products['productID']; ?>&cmd=delete" class="btn btn-primary" style="padding: 2px 2px 2px 2px"> Delete </a> -->
        <a href="#" onclick="doDelete(<?php echo $officeID; ?>, <?php echo $products['productID']; ?>)" class="btn btn-primary" style="padding: 2px 2px 2px 2px"> Delete </a>
      </td>
    </tr>
  <?php } ?>
</table>
