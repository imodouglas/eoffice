<?php
    if(!isset($_GET['id'])){
        header("Location: home.php");
    } else {
        include '../engine/conn.php';
        include '../engine/engine.php';
        if(isset($_SESSION['eo_user_session'])){
            $userData = userData($conn,$_SESSION['eo_user_session']);
        } else {
            header("Location: index.php");
        }
        if(checkOffice ($conn,$_GET['id'], $userData['userID']) == 0){
            header("Location: home.php");
        }
    }
    include 'includes/content/add-service.php';
    if(isset($_GET['service'], $_GET['cmd']) && $_GET['cmd'] == "delete"){
        $delProd = $conn->prepare("DELETE FROM services WHERE serviceID = ?");
        $delProd->execute(array($_GET['service']));
        if($delProd){ echo "<script> alert('Service deleted!'); window.location = 'services.php?id=".$_GET['id']."'; </script>"; }
    }

    if(isset($_POST['upProd'])){
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !== ""){
            $imgName = time().rand(1111,9999);
            $dir = "assets/images/products/";

            if(resizeImage($_FILES['file']['name'], $_FILES['file']['tmp_name'], $imgName, $dir) == 0){
                if(updateServices2($conn, $_POST['serviceName'], $_POST['serviceDesc'],$_SESSION['UploadImgName'], $_POST['serviceID']) == 1){
                    unset($_SESSION['UploadImgName']);
                    echo "<script> alert('Service updated successfully!'); window.location = 'services.php?id=".$_GET['id']."&product=".$_GET['service']."'; </script>";
                } else{
                    echo "<script> alert('Error updating service!'); window.location = 'services.php?id=".$_GET['id']."&product=".$_GET['service']."'; </script>";
                }
            } else {
                echo "<script> alert('Something went wrong with image upload!'); window.location = 'services.php?id=".$_GET['id']."&product=".$_GET['service']."'; </script>";
            }
        } else {
            if(updateServices($conn, $_POST['serviceName'], $_POST['serviceDesc'], $_POST['serviceID']) == 1){
                echo "<script> alert('Service updated successfully!'); window.location = 'services.php?id=".$_GET['id']."&product=".$_GET['service']."'; </script>";
            } else{
                echo "<script> alert('Error updating service!'); window.location = 'services.php?id=".$_GET['id']."&product=".$_GET['service']."'; </script>";
            }
        }
    }

    $officeID = $_GET['id'];
    $siteData = siteData($conn,$officeID);
?>

<!DOCTYPE html>
<html  >
<head>
    <title>Manage - <?php echo $siteData['officeName']; ?> | eOffice NG</title>
    <meta name="description" content="eOffice Nigeria is online business solution that helps give business owners an online representation of their business / brand. If you don't have an eOffice, then you are not ready for business.">
    <?php include 'includes/tags/header.php'; ?>
</head>
<body>
  
<?php include 'includes/menu.php'; ?>

    <section class="header6 cid-s5u5s3HuN0" id="header6-2" style="padding:30px 10px">
        <div class="container">
            <?php include 'includes/publish-notify.php';  ?>
            <a href="office.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary" style="margin-bottom:20px"> <i class="fas fa-arrow-left"></i> Return to Manager </a>
            <div class="row">
                <?php if(!isset($_GET['service']) && !isset($_GET['cmd'])){ ?>
                    <div class="col-sm-3">
                        <div class="item-container">
                            <div class="item-header">
                            ADD SERVICE
                            </div>
                            <div style="border-top:#333 thin solid; padding:10px">
                            <form method="post" enctype="multipart/form-data" action="">
                                <!-- <p>
                                    Select Category:
                                    <select name="catID" class="form-control">
                                        <?php foreach($getCategories AS $categories){ ?>
                                        <option value="<?php echo $categories['catID']; ?>"> <?php echo $categories['catName']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </p> -->
                                <p>
                                    Service Name:
                                    <input type="text" name="serviceName" class="form-control" required>
                                </p>
                                <p>
                                    Service Description:
                                    <textarea name="serviceDesc" class="form-control" style="height:150px"></textarea>
                                </p>
                                <p>
                                    Upload Product Image:
                                    <input size="25" name="file" type="file" class="form-control" required />
                                </p>
                                <!-- <p>
                                    Product Status:
                                    <select name="productStatus" class="form-control">
                                        <option value="In Stock"> In Stock </option>
                                        <option value="Out of Stock"> Out of Stock </option>
                                    </select>
                                </p> -->
                                <input type="submit" name="addProd" class="btn btn-black form-control" style="padding: 5px 5px 5px 5px" value="Add" />
                            </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-sm-9">
                    <div class="item-container">
                        <div class="item-header">
                        SERVICES
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px">

                        <?php if(isset($_GET['service']) && !isset($_GET['cmd'])){ ?>
                            <div style='margin-bottom:30px'><a href='services.php?id=<?php echo $_GET['id']; ?>'> <i class='fas fa-arrow-left'></i> Return to products </a></div>
                            <?php
                                $getproductsq = $conn->prepare("SELECT * FROM services WHERE serviceID = ?");
                                $getproductsq->execute(array($_GET['service']));
                                $getproductsct = $getproductsq->rowCount();
                                $getproducts = $getproductsq->fetchAll();
                                foreach($getproducts AS $products){
                                ?>
                                <form method="post" enctype="multipart/form-data" action="">
                                    <p>
                                    <input type="hidden" name="serviceID" value="<?php echo $products['serviceID']; ?>">
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
                                    Serivce Name:
                                    <input type="text" name="serviceName" value="<?php echo $products['serviceName']; ?>" class="form-control">
                                    </p>
                                    <p>
                                    Services Description:
                                    <textarea name="serviceDesc" class="form-control" style="height:100px"><?php echo $products['serviceDesc']; ?></textarea>
                                    </p>
                                    <p>
                                    <!-- Product Price:
                                    <input type="text" name="productPrice" value="<?php echo $products['productPrice']; ?>" class="form-control">
                                    </p> -->
                                    <p>
                                    Product Image:
                                    <input type="file" name="file" class="form-control">
                                    </p>
                                    <p>
                                    <!-- Product Status:
                                    <select name="productStatus" class="form-control">
                                        <option value="In Stock" <?php if($products['productStatus'] == "In Stock"){ echo "selected"; } ?>> In Stock </option>
                                        <option value="Out of Stock" <?php if($products['productStatus'] == "Out of Stock"){ echo "selected"; } ?>> Out of Stock </option>
                                    </select>
                                    </p> -->
                                    <p>
                                    <input type="submit" name="upProd" class="btn btn-primary"  value="Update" />
                                    </p>
                                </form>
                                <?php } ?>
                        <?php } else { ?>
                            <table style="width:100%">
                                <tr>
                                    <!-- <th style="padding:10px; width:40%;"> Category </th> -->
                                    <th style="padding:10px; width:30%;"> Services Name </th>
                                    <th style="padding:10px; width:50%;"> Service Description </th>
                                    <th style="padding:10px; width:20%;"> Action </th>
                                </tr>
                                <?php
                                    foreach(oServices($conn,$officeID) AS $products){
                                ?>
                                    <tr style="border-bottom:#999 thin solid">
                                    <!-- <td style="padding:10px;">
                                        <?php echo $products['catName']; ?>
                                    </td> -->
                                    <td style="padding:10px;">
                                        <?php echo $products['serviceName']; ?>
                                    </td>
                                    <td style="padding:10px;">
                                        <?php echo $products['serviceDesc']; ?>
                                    </td>
                                    <td style="padding:10px;">
                                        <a href="?id=<?php echo $officeID; ?>&service=<?php echo $products['serviceID']; ?>" class="btn btn-black" style="padding: 2px 2px 2px 2px"> Edit </a>
                                        <!-- <a href="?id=<?php echo $officeID; ?>&product=<?php echo $products['serviceID']; ?>&cmd=delete" class="btn btn-primary" style="padding: 2px 2px 2px 2px"> Delete </a> -->
                                        <a href="#" onclick="doDelete(<?php echo $officeID; ?>, <?php echo $products['serviceID']; ?>)" class="btn btn-primary" style="padding: 2px 2px 2px 2px"> Delete </a>
                                    </td>
                                    </tr>
                                <?php } ?>
                            </table>

                        <?php  } ?>

                        </div>
                    </div>
                </div>
 
          </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>

<!-- <div style="background:#000; width:100%; height:100vh; opacity:0.5; z-index:3000;">...</div> -->
<?php include 'includes/modals.php'; ?>

  <script src="https://checkout.flutterwave.com/v3.js"></script>
  <script src="../assets/web/assets/jquery/jquery.min.js"></script>
  <script>
    function doDelete(a, e){
        if (confirm('Are you sure you want to delete this service?')) {
            window.location = "services.php?id="+a+"&service="+e+"&cmd=delete";
        } else {
            console.log("closed");
        }
    }
  </script>
  <script src="../assets/popper/popper.min.js"></script>
  <script src="../assets/tether/tether.min.js"></script>
  <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../assets/dropdown/js/nav-dropdown.js"></script>
  <script src="../assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="../assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="../assets/viewportchecker/jquery.viewportchecker.js"></script>
  <script src="../assets/theme/js/script.js"></script>  
  <script src="../engine/js/script.js"></script>
  
  <input name="animation" type="hidden">
  </body>
</html>
