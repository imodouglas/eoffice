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
    
    if(isset($_POST['addPortfolio'])){
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !== ""){
            $randImage = time().$_GET['id'];
            $dir = "assets/images/portfolio/";
            resizeImage($_FILES['file']['name'], $_FILES['file']['tmp_name'], $randImage, $dir);
            $query = $conn->prepare("INSERT INTO portfolio(officeID, portfolioName, portfolioImg, portfolioText, portfolioLink, portfolioBtn, postType) VALUES (?,?,?,?,?,?,?)");
            $query->execute(array($_GET['id'], $_POST['name'], $_SESSION['UploadImgName'], $_POST['desc'], $_POST['link'], $_POST['linkbtn'], $_POST['postType']));
            if($query){
                echo "<script> alert('Portfolio added successfully!'); window.location='?id=".$_GET['id']."'; </script>";
            } else {
                echo "<script> alert('An error occured! Try again.'); </script>";
            }
        } else {
            if($_POST['video'] !== ""){ $video = cleanURL($_POST['video']);  } else {$video = ""; }
            $query = $conn->prepare("INSERT INTO portfolio(officeID, portfolioName, portfolioImg, portfolioText, portfolioLink, portfolioBtn, postType) VALUES (?,?,?,?,?,?,?)");
            $query->execute(array($_GET['id'], $_POST['name'], $video, $_POST['desc'], $_POST['link'], $_POST['linkbtn'], $_POST['postType']));
            if($query){
                echo "<script> alert('Portfolio added successfully!'); window.location='?id=".$_GET['id']."'; </script>";
            } else {
                echo "<script> alert('An error occured! Try again.'); </script>";
            }
        }
    }

    if(isset($_GET['portfolio'], $_GET['cmd']) && $_GET['cmd'] == "delete"){
        $delProd = $conn->prepare("DELETE FROM portfolio WHERE portfolioID = ?");
        $delProd->execute(array($_GET['portfolio']));
        if($delProd){ echo "<script> alert('Portfolio deleted!'); window.location = 'portfolio.php?id=".$_GET['id']."'; </script>"; }
    }

    if(isset($_POST['upPortfolio'])){
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !== ""){
            $imgName = time().rand(1111,9999);
            $dir = "assets/images/portfolio/";

            resizeImage($_FILES['file']['name'], $_FILES['file']['tmp_name'], $imgName, $dir);
            $query = $conn->prepare("UPDATE portfolio SET portfolioName=?, portfolioImg=?, portfolioText=?, portfolioLink=?, portfolioBtn=? WHERE portfolioID=?");
            $query->execute(array($_POST['name'], $_SESSION['UploadImgName'], $_POST['desc'], $_POST['link'], $_POST['linkbtn'], $_POST['portfolioID']));
            if($query){
                echo "<script> alert('Portfolio updated successfully!'); window.location = 'portfolio.php?id=".$_GET['id']."&portfolio=".$_GET['portfolio']."'; </script>";
            } else {
                echo "<script> alert('Error updating portfolio!'); window.location = 'portfolio.php?id=".$_GET['id']."&portfolio=".$_GET['portfolio']."'; </script>";
            }
        } else {
            $query = $conn->prepare("UPDATE portfolio SET portfolioName=?, portfolioText=?, portfolioLink=?, portfolioBtn=? WHERE portfolioID=?");
            $query->execute(array($_POST['name'], $_POST['desc'], $_POST['link'], $_POST['linkbtn'], $_POST['portfolioID']));
            if($query){
                echo "<script> alert('Portfolio updated successfully!'); window.location = 'portfolio.php?id=".$_GET['id']."&portfolio=".$_GET['portfolio']."'; </script>";
            } else {
                echo "<script> alert('Error updating portfolio!'); window.location = 'portfolio.php?id=".$_GET['id']."&portfolio=".$_GET['portfolio']."'; </script>";
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
                <?php if(!isset($_GET['portfolio']) && !isset($_GET['cmd'])){ ?>
                    <div class="col-sm-3">
                        <div class="item-container">
                            <div class="item-container" style="display:block">
                                <button class="btn btn-dark"  onclick="portToggle()"> <i class="fas fa-plus"></i> Add Portfolio </button>
                            </div>
                            <div id="addPort" style="display:none">
                                <div class="item-header">
                                    ADD PORTFOLIO
                                    <div style="float:right; cursor:pointer" onclick="portToggle()"> <i class="fas fa-times"></i> </div>
                                </div>
                                <div style="border-top:#333 thin solid; padding:10px;">
                                    <form method="post" enctype="multipart/form-data" action="">
                                        <span id="postType"></span>
                                        <p>
                                            portfolio Title:
                                            <input type="text" name="name" class="form-control" required />
                                        </p>
                                        <p>
                                            Description (150 characters):
                                            <textarea name="desc" class="form-control" style="height:150px" maxlength="150"></textarea>
                                        </p>
                                        <p>
                                            Link (leave blank if none):
                                            <input type="text" name="link" class="form-control" required />
                                        </p>
                                        <p>
                                            Link Button (leave blank if none):
                                            <input type="text" name="linkbtn" value="Learn More..." class="form-control" required />
                                        </p>
                                        <p>
                                            <div class="row">
                                                <div class="col-12"> Add Media: </div>
                                                <div class="col-6">
                                                    <span class="btn btn-primary w100" id="addImageBtn" style="padding:1px 10px; magin:5px;"> <i class="fas fa-image"></i> &nbsp;Image </span>
                                                </div>
                                                <div class="col-6">
                                                    <span href="#" class="btn btn-primary w100" id="addVideoBtn" style="padding:1px 10px; magin:5px"> <i class="fas fa-video"></i> &nbsp;Video </span>
                                                </div>
                                            </div>
                                        
                                        </p>
                                        <p id="addImage" style="display:none">
                                            Upload portfolio Image: <br> <span style='color:#070; font-size:12px'> (leave blank if none) </span>
                                            <input size="25" name="file" type="file" class="form-control" />
                                        </p>
                                        <p id="addVideo" style="display:none">
                                            YouTube Link: <br> <span style='color:#070; font-size:12px'> (leave blank if none) </span>
                                            <input type="text" name="video" class="form-control" />
                                        </p>
                                        <!-- <p>
                                            Product Status:
                                            <select name="productStatus" class="form-control">
                                                <option value="In Stock"> In Stock </option>
                                                <option value="Out of Stock"> Out of Stock </option>
                                            </select>
                                        </p> -->
                                        <input type="submit" name="addPortfolio" class="btn btn-black form-control" style="padding: 5px 5px 5px 5px" value="Add" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-sm-9">
                    <div class="item-container">
                        <div class="item-header">
                        PORTFOLIO
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px">

                        <?php if(isset($_GET['portfolio']) && !isset($_GET['cmd'])){ ?>
                            <div style='margin-bottom:30px'><a href='portfolio.php?id=<?php echo $_GET['id']; ?>'> <i class='fas fa-arrow-left'></i> Return to portfolio </a></div>
                            <?php
                                 $portfolio = getPortfolio($conn,$_GET['portfolio']);
                                ?>
                                <form method="post" enctype="multipart/form-data" action="">
                                    <p>
                                        <input type="hidden" name="portfolioID" value="<?php echo $portfolio['portfolioID']; ?>">
                                    </p>
                                    <!-- <p>
                                    Product Category:
                                    <select name="catID" class="form-control">
                                        <?php foreach($getCategories AS $categories){ if($categories['catID'] == $portfolio['catID']){ $pactive = "selected"; } else{ $pactive = ""; } ?>
                                        <option value="<?php echo $categories['catID']; ?>" <?php echo $pactive; ?>> <?php echo $categories['catName']; ?> </option>
                                        <?php } ?>
                                    </select>
                                    </p> -->
                                    <p>
                                        Title:
                                        <input type="text" name="name" value="<?php echo $portfolio['portfolioName']; ?>" class="form-control">
                                    </p>
                                    <p>
                                        Description (150 characters):
                                        <textarea name="desc" class="form-control" style="height:150px" maxlength="150"><?php echo $portfolio['portfolioText']; ?></textarea>
                                    </p>
                                    <p>
                                        Link (leave blank if none):
                                        <input type="text" name="link" value="<?php echo $portfolio['portfolioLink']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        Link Button (leave blank if none):
                                        <input type="text" name="linkbtn" value="<?php echo $portfolio['portfolioBtn']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        Product Image:
                                        <input type="file" name="file" class="form-control">
                                    </p>
                                    <p>
                                    <p>
                                    <input type="submit" name="upPortfolio" class="btn btn-primary"  value="Update" />
                                    </p>
                                </form>

                        <?php } else { ?>
                            <div class="row">
                                <?php foreach(oPortfolio($conn,$officeID) AS $portfolio){ ?>
                                    <div class="col-sm-4 p10">
                                        <div class="eo-light-bg" style="padding:0 !important">
                                            <?php if($portfolio['portfolioImg'] !== ""){ if($portfolio['postType'] == "image") { ?>
                                                <img src="../<?php echo $portfolio['portfolioImg']; ?>" style="width:100% !important" />
                                            <?php } else if($portfolio['postType'] == "video") {?>
                                                <iframe style="width:100%; min-height:300px" src="<?php echo cleanVURL($portfolio['portfolioImg']); ?>" frameborder="0" allowfullscreen></iframe>
                                            <?php } } ?>
                                            <div class="p10">
                                                <b> <?php echo $portfolio['portfolioName']; ?> </b>
                                                <p> <?php echo $portfolio['portfolioText']; ?> </p>
                                                <p> <i class="fas fa-link"></i> <?php echo $portfolio['portfolioLink']; ?> </p>
                                                <p> <span class="btn btn-primary w100 m0"> <?php echo $portfolio['portfolioBtn']; ?> </span> </p>
                                                <div>
                                                    <a href="?id=<?php echo $officeID; ?>&portfolio=<?php echo $portfolio['portfolioID']; ?>" class="btn btn-black" style="padding: 2px 2px 2px 2px; width:40%"> <i class="fas fa-edit"></i> Edit </a>
                                                    <a href="#" onclick="doDelete(<?php echo $officeID; ?>, <?php echo $portfolio['portfolioID']; ?>)" class="btn btn-danger" style="padding: 2px 2px 2px 2px; width:40%"> <i class="fas fa-trash"></i> Delete </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

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
        if (confirm('Are you sure you want to delete this portfolio?')) {
            window.location = "portfolio.php?id="+a+"&portfolio="+e+"&cmd=delete";
        } else {
            console.log("closed");
        }
    }

    function portToggle(){
        $("#addPort").slideToggle("slow");
    };

    $("#addImageBtn").click(function(){
        $("#addVideo").hide();
        $("#addImage").slideToggle("slow");
        $("#postType").html("<input type='hidden' name='postType' value='image' />");
    });

    $("#addVideoBtn").click(function(){
        $("#addImage").hide();
        $("#addVideo").slideToggle("slow");
        $("#postType").html("<input type='hidden' name='postType' value='video' />");
    });

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
