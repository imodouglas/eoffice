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

    if(isset($_POST['editOption'])){
        $phone = explode("+234", $_POST['phone']);
        $phone = implode("234", $phone);
        if(editOption($conn,$_POST['officeName'],$_POST['officeDesc'],$phone,$_POST['whatsapp'],$_POST['showPrice'],$_GET['id']) == 1){
          if($_FILES['logo']['tmp_name'] == ""){
            echo "<script> alert('Options updated successfully'); </script>";
          } else {
            if(resizeImage($_FILES["logo"]["name"], $_FILES["logo"]["tmp_name"], $_GET['id'], "assets/images/logos/") == 0){
              updateLogo($conn, $_GET['id'], $_SESSION['UploadImgName']);
              echo "<script> alert('Options updated successfully'); </script>";
            } else {
              echo "<script> alert('Options updated successfully but logo not uploaded'); </script>";
            }
          }
        } else {
            echo "<script> alert('Error occured while updating options'); </script>";
        }
    }

    if(isset($_POST['editSocial'])){
      $query = $conn->prepare("UPDATE settings SET facebook=?, instagram=?, twitter=?, linkedin=?, youtube=? WHERE officeID = ?");
      $query->execute(array($_POST['facebook'],$_POST['instagram'],$_POST['twitter'],$_POST['linkedin'],$_POST['youtube'],$_GET['id']));
      if($query){
        echo "<script> alert('Social accounts updated successfully'); </script>";
      } else {
        echo "<script> alert('Error occured while updating social accounts'); </script>";
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
            <div class="col-sm-8">
              <div class="item-container">
                <div class="item-header">
                  OPTIONS
                </div>
                <div style="border-top:#333 thin solid; padding:5px">
                  <form method="post" enctype="multipart/form-data" action="">
                    <div style="padding:10px">
                      eOffice Name:
                      <input type="text" name="officeName" class="form-control" value="<?php echo $siteData['officeName']; ?>" />
                    </div>
                    <div style="padding:10px">
                      eOffice description:
                      <textarea name="officeDesc" class="form-control" style="height:100px" placeholder="Enter office description here"><?php echo $siteData['officeDesc']; ?></textarea>
                    </div>
                    <div style="padding:10px">
                      <div align="left"><?php if($siteData['officeLogo'] !==""){ echo "<img src='../".$siteData['officeLogo']."' style='max-width:70px; margin:0 !important' />"; } else { echo "<img src='../assets/images/logo-only-430x326.png' style='max-width:70px; margin:0 !important' />"; } ?></div>
                      Change Logo:
                      <input type="file" name="logo" class="form-control" />
                    </div>
                    <div style="padding:10px">
                      Whatsapp Phone No. (e.g 2348012345678):
                      <input type="number" name="phone" class="form-control" value="<?php if($siteData['phoneNo'] == ""){ echo "234"; } else { echo $siteData['phoneNo']; } ?>" />
                    </div>
                    <div style="padding:10px">
                      Whatsapp Message: <br /><span style="font-size:12px; color:red"> [product-name] displays the product name </span>
                      <input type="text" name="whatsapp" class="form-control" value="<?php echo $siteData['defText']; ?>" />
                    </div>
                    <div style="padding:10px">
                      Show Prices:
                      <select name="showPrice" class="form-control">
                        <option value="yes" <?php if($siteData['showPrices'] == "yes"){ echo "selected"; } ?> > Yes </option>
                        <option value="no" <?php if($siteData['showPrices'] == "no"){ echo "selected"; } ?>> No </option>
                      </select>
                    </div>
                    <input type="submit" name="editOption" class="btn btn-black form-control" style="padding: 2px 2px 2px 2px" value="Update" />
                  </form>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="item-container">
                <div class="item-header">
                  SOCIAL MEDIA SETTING
                </div>
                <div style="border-top:#333 thin solid; padding:5px">
                  <form method="post" enctype="multipart/form-data" action="">
                    <div style="padding:10px">
                      Facebook Link:
                      <input type="text" name="facebook" class="form-control" value="<?php echo $siteData['facebook']; ?>" />
                    </div>
                    <div style="padding:10px">
                      Instagram Link:
                      <input type="text" name="instagram" class="form-control" value="<?php echo $siteData['instagram']; ?>" />
                    </div>
                    <div style="padding:10px">
                      Twitter Link:
                      <input type="text" name="twitter" class="form-control" value="<?php echo $siteData['twitter']; ?>" />
                    </div>
                    <div style="padding:10px">
                      Linkedin Link:
                      <input type="text" name="linkedin" class="form-control" value="<?php echo $siteData['linkedin']; ?>" />
                    </div>
                    <div style="padding:10px">
                      Youtube Link:
                      <input type="text" name="youtube" class="form-control" value="<?php echo $siteData['youtube']; ?>" />
                    </div>
                    <input type="submit" name="editSocial" class="btn btn-black form-control" style="padding: 2px 2px 2px 2px" value="Update" />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/modals.php'; ?>

  <script src="https://checkout.flutterwave.com/v3.js"></script>
  <script src="../assets/web/assets/jquery/jquery.min.js"></script>
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
