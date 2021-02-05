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

    $officeID = $_GET['id'];
    $siteData = siteData($conn,$officeID);

    if(isset($_POST['uploadImages'])){
      function getExtension($str) {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
      }
      $ilval = intval($_POST['ileft']);
      $files = array_filter($_FILES['file']['name']);
      $icount = count($_FILES['file']['name']);
      if($icount > $ilval){ $icount =  $ilval;}
      $err = 0;
      for($i = 0; $i < $icount; $i++){
        $inputName = $_FILES["file"]["name"][$i];
        $inputTmp = $_FILES["file"]["tmp_name"][$i];
        $dir = $siteData['officeDomain']."/";
        $randImage = time().rand(11,99);
        $res = galUpload($inputName, $inputTmp, $randImage, $dir);
        $err = $err+$res;
        if($res == 0){
          $newRes = addGallery($conn, $_GET['id'], $_SESSION['UploadImgName']);
          unset($_SESSION['UploadImgName']);
        }
      }
      if($err == 0){
        echo "<script> alert('Images have been added successfully'); window.location='?id=".$_GET['id']."'; </script>";
      } else {
        echo "<script> alert('An error occured! Try again.'); </script>";
      }
    }
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
                  <?php $gct = getGalleryct($conn,$_GET['id']); $ileft = 10-$gct; ?>
                  GALLERY IMAGES - <?php echo $gct."/10"; if($ileft > 0){ ?> <span class="btn btn-primary" style="padding:3px 10px" onclick="toggleaForm()"> <i class="fas fa-plus-circle"></i>&nbsp; Add Photos </a> <?php } ?>
                </div>
                <div style="border-top:#333 thin solid; padding:5px" class="row">
                  <div class="col-12 p10" id="addImages" style="display:none">
                    <p style="margin-bottom:20px; margin-top:20px"> UPLOAD IMAGES <span class="btn btn-primary" style="padding:1px 5px; font-size:12px" onclick="toggleaForm()"> <i class="fas fa-times"></i></span> </p>
                    <form method="post" action="" enctype="multipart/form-data">
                      <input type="hidden" name="ileft" value="<?php echo $ileft; ?>" />
                      <p>
                          <label> multiple selection allowed </label>
                          <input type="file" name="file[]" class="form-control" style="max-width:400px" multiple />
                        </p>
                      <!-- <?php for($i=1; $i < $ileft+1; $i++){ ?>
                        <p>
                          <label> <?php echo "Image ".$i; ?> (optional) </label>
                          <input type="file" name="file<?php echo $i; ?>" class="form-control" style="max-width:400px" />
                        </p>
                      <?php } ?> -->
                      <button type="submit" name="uploadImages" class="btn btn-primary"> <i class="fas fa-upload"></i> &nbsp; Upload Images </button>
                    </form>
                  </div>
                  <div class="col-12 p10">
                    <div class="row">
                      <?php 
                        if($gct == 0) { echo "You do not have an image in your gallery."; }
                        foreach(getGallery($conn,$_GET['id']) AS $img){ 
                          $jsq =  $img["gImageID"].",".$img["gImage"];
                      ?>
                        <div class="col-sm-4 p10">
                          <div align="right"> <i class="fas fa-times-circle" style="color:red; cursor:pointer" onclick="delImage('<?php echo $jsq; ?>')"></i> </div>
                          <img src="<?php echo $siteURL."/".$img['gImage']; ?>" style="width:100%" />
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4">

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
  
  <script>
    function toggleaForm(){
      $("#addImages").slideToggle("slow");
    }

    function delImage(x,y){
      if(confirm('Are you sure you want to delete this image?')){
        showLoading();
        $.get(siteURL+"/engine/data.php?cmd=delimage&id="+x+"&dir="+y, function(data){
          console.log(data);
          if(data == 1){
            showLoading();
            alert("Image deleted successfully");
            location.reload();
          } else {
            showLoading();
            alert("An error occured!");
          }
        });
      }
    }
  </script>
  
  <input name="animation" type="hidden">
  </body>
</html>
