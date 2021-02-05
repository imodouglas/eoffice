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
    include 'includes/content/add-product.php';
    if(isset($_GET['product'], $_GET['cmd']) && $_GET['cmd'] == "delete"){
        $delProd = $conn->prepare("DELETE FROM products WHERE productID = ?");
        $delProd->execute(array($_GET['product']));
        if($delProd){ echo "<script> alert('Product deleted!'); window.location = 'products.php?id=".$_GET['id']."'; </script>"; }
    }

    if(isset($_POST['upProd'])){
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !== ""){
            if(getProduct($conn,$_POST['productID'])['productPhoto'] !== ""){
                $imgName = strtolower(getProduct($conn,$_POST['productID'])['productPhoto']);
                $imgName = explode("assets/images/products/", $imgName);
                $imgName = implode("", $imgName);
                $imgName = explode(".jpg", $imgName);
                $imgName = implode("", $imgName);
                $imgName = explode(".jpeg", $imgName);
                $imgName = implode("", $imgName);
                $imgName = explode(".png", $imgName);
                $imgName = implode("", $imgName);
                $imgName = explode(".gif", $imgName);
                $imgName = implode("", $imgName);
                $imgName = explode(".webp", $imgName);
                $imgName = implode("", $imgName);
            } else {
                $imgName = time().rand(1111,9999);
            }
            $dir = "assets/images/products/";

            if(resizeImage($_FILES['file']['name'], $_FILES['file']['tmp_name'], $imgName, $dir) == 0){
                if(updateProducts2($conn, $_POST['productName'], $_POST['productDesc'], $_POST['productPrice'], $_SESSION['UploadImgName'], $_POST['productStatus'], $_POST['productID']) == 1){
                    unset($_SESSION['UploadImgName']);
                    echo "<script> alert('Product updated successfully!'); window.location = 'products.php?id=".$_GET['id']."&product=".$_GET['product']."'; </script>";
                } else{
                    echo "<script> alert('Error updating product!'); window.location = 'products.php?id=".$_GET['id']."&product=".$_GET['product']."'; </script>";
                }
            } else {
                echo "<script> alert('Something went wrong with image upload!'); window.location = 'products.php?id=".$_GET['id']."&product=".$_GET['product']."'; </script>";
            }
        } else {
            if(updateProducts($conn, $_POST['productName'], $_POST['productDesc'], $_POST['productPrice'], $_POST['productStatus'], $_POST['productID']) == 1){
                echo "<script> alert('Product updated successfully!'); window.location = 'products.php?id=".$_GET['id']."&product=".$_GET['product']."'; </script>";
            } else{
                echo "<script> alert('Error updating product!'); window.location = 'products.php?id=".$_GET['id']."&product=".$_GET['product']."'; </script>";
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
                <?php if(!isset($_GET['product']) && !isset($_GET['cmd'])){ ?>
                    <div class="col-sm-3">
                        <button name="showAdd" class="btn btn-primary" onclick="showAdd()"> <i class="fas fa-plus"> </i> &nbsp;Add Product </button>
                        <div class="item-container" id="showAdd" style="display:none">
                            <div class="item-header">
                            ADD PRODUCT <span style="float:right; color:green" onclick="showAdd()"> <i class="fas fa-times"></i> </span>
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
                                    Product Name:
                                    <input type="text" name="productName" class="form-control" required>
                                </p>
                                <p>
                                    Product Description:
                                    <textarea name="productDesc" class="form-control" style="height:150px"></textarea>
                                </p>
                                <p>
                                    Enter Product Price:
                                    <input type="number" name="productPrice" class="form-control">
                                </p>
                                <p>
                                    Upload Product Image:
                                    <input size="25" name="file" type="file" class="form-control" required />
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
                <?php } ?>
                <div class="col-sm-9">
                    <div class="item-container">
                        <div class="item-header">
                        PRODUCTS
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px">

                        <?php
                            if(isset($_GET['product']) && !isset($_GET['cmd'])){
                                echo "<div style='margin-bottom:30px'><a href='products.php?id=".$_GET['id']."'> <i class='fas fa-arrow-left'></i> Return to products </a></div>";
                                include 'includes/content/product-edit.php';
                            } else {
                                include 'includes/content/show-products.php';
                            }
                        ?>

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
        if (confirm('Are you sure you want to delete this product?')) {
            window.location = "products.php?id="+a+"&product="+e+"&cmd=delete";
        } else {
            console.log("closed");
        }
    }

    function showAdd(){
        $("#showAdd").slideToggle("slow");
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
