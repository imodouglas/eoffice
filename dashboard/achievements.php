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
    
    if(isset($_POST['addAcmt'])){
        if($_POST['end'] == ""){ $end = "Present"; } else { $end = $_POST['end']; }
        $query = $conn->prepare("INSERT INTO achievements(officeID, acmtCompany, acmtLocation, acmtStart, acmtEnd, acmtPosition, acmtDesc, acmtType) VALUES (?,?,?,?,?,?,?,?)");
        $query->execute(array($_GET['id'], $_POST['company'], $_POST['location'], $_POST['start'], $end, $_POST['position'], $_POST['desc'], "Experience"));
        if($query){
            echo "<script> alert('Achievement added successfully!'); window.location='?id=".$_GET['id']."'; </script>";
        } else {
            echo "<script> alert('An error occured! Try again.'); </script>";
        }
    }

    if(isset($_POST['addExp'])){
        $query = $conn->prepare("INSERT INTO achievements(officeID, acmtCompany, acmtDesc, acmtType) VALUES (?,?,?,?)");
        $query->execute(array($_GET['id'], $_POST['skill'], $_POST['desc'], "Expertise"));
        if($query){
            echo "<script> alert('Achievement added successfully!'); window.location='?id=".$_GET['id']."'; </script>";
        } else {
            echo "<script> alert('An error occured! Try again.'); </script>";
        }
    }

    if(isset($_GET['achievement'], $_GET['cmd']) && $_GET['cmd'] == "delete"){
        $delProd = $conn->prepare("DELETE FROM achievements WHERE acmtID = ?");
        $delProd->execute(array($_GET['achievement']));
        if($delProd){ echo "<script> alert('Achievement deleted!'); window.location = 'achievements.php?id=".$_GET['id']."'; </script>"; }
    }

    if(isset($_POST['upAcmt'])){
        if($_POST['end'] == ""){ $end = "Present"; } else { $end = $_POST['end']; }
        $query = $conn->prepare("UPDATE achievements SET acmtCompany=?, acmtLocation=?, acmtStart=?, acmtEnd=?, acmtPosition=?, acmtDesc=? WHERE acmtID=?");
        $query->execute(array($_POST['company'], $_POST['location'], $_POST['start'], $end, $_POST['position'], $_POST['desc'], $_POST['acmtID']));
        if($query){
            echo "<script> alert('Achievement updated successfully!'); window.location='?id=".$_GET['id']."&achievement=".$_POST['acmtID']."'; </script>";
        } else {
            echo "<script> alert('An error occured! Try again.'); </script>";
        }
    }

    if(isset($_POST['upExp'])){
        $query = $conn->prepare("UPDATE achievements SET acmtCompany=?, acmtDesc=? WHERE acmtID=?");
        $query->execute(array($_POST['skill'], $_POST['desc'], $_POST['acmtID']));
        if($query){
            echo "<script> alert('Achievement updated successfully!'); window.location='?id=".$_GET['id']."&achievement=".$_POST['acmtID']."'; </script>";
        } else {
            echo "<script> alert('An error occured! Try again.'); </script>";
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
                <div class="col-sm-4">
                    <div class="item-container" style="display:block">
                        <button id="addExperience" class="btn btn-dark"> <i class="fas fa-plus"></i> Add Work Experience </button>
                        <button id="addExpertise" class="btn btn-dark"> <i class="fas fa-plus"></i> Add Expertise </button>
                    </div>
                    <div class="item-container" id="showExperience" style="display:none">
                        <div class="item-header">
                            ADD WORK EXPERIENCE
                            <div style="float:right; cursor:pointer" onclick="closeAddAcmt()"> <i class="fas fa-times"></i> </div>
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px">
                            <form method="post" enctype="multipart/form-data" action="">
                                
                                <input type="hidden" name="type" value="Experience">
                                <p>
                                    Organization Name:
                                    <input type="text" name="company" class="form-control" required>
                                </p>
                                <p>
                                    Organization Location:
                                    <input type="text" name="location" placeholder="e.g Lagos, Nigeria" class="form-control" required>
                                </p>
                                <p>
                                    Start Year:
                                    <input type="number" name="start" placeholder="e.g 2005" class="form-control" required>
                                </p>
                                <p>
                                    End year: <br>
                                    <span style="color:red; font-size:12px"> (leave blank for current job) </span>
                                    <input type="number" name="end" placeholder="e.g 2010" class="form-control">
                                </p>
                                <p>
                                    Position Held:
                                    <input type="text" name="position" class="form-control" required>
                                </p>
                                <p>
                                    Job Description (150 characters):
                                    <textarea name="desc" class="form-control" style="height:150px" maxlength="150"></textarea>
                                </p>
                                
                                <input type="submit" name="addAcmt" class="btn btn-black form-control" style="padding: 5px 5px 5px 5px" value="Add" />
                            </form>
                        </div>
                    </div>

                    <div class="item-container" id="showExpertise" style="display:none">
                        <div class="item-header">
                            ADD EXPERTISE
                            <div style="float:right; cursor:pointer" onclick="closeAddAcmt()"> <i class="fas fa-times"></i> </div>
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px">
                            <form method="post" enctype="multipart/form-data" action="">
                                <input type="hidden" name="type" value="Expertise">
                                <p>
                                    Skill:
                                    <input type="text" name="skill" class="form-control" required>
                                </p>
                                <p>
                                    Skill Description:
                                    <input type="text" name="desc" class="form-control" required>
                                </p>
                                
                                <input type="submit" name="addExp" class="btn btn-black form-control" style="padding: 5px 5px 5px 5px" value="Add" />
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="item-container">
                        <div class="item-header">
                            ACHIEVEMENTS
                        </div>
                        <div style="border-top:#333 thin solid; padding:10px">

                        <?php if(isset($_GET['achievement']) && !isset($_GET['cmd'])){ ?>
                            <div style='margin-bottom:30px'><a href='achievements.php?id=<?php echo $_GET['id']; ?>'> <i class='fas fa-arrow-left'></i> Return to achievement </a></div>
                            <?php 
                                $acmt = getAcmt($conn,$_GET['achievement']);
                                if($acmt['acmtType'] == "Experience"){
                            ?>
                                <form method="post" enctype="multipart/form-data" action="">
                                    <p>
                                        <input type="hidden" name="acmtID" value="<?php echo $acmt['acmtID']; ?>">
                                    </p>
                                    <p>
                                        Organization Name:
                                        <input type="text" name="company" value="<?php echo $acmt['acmtCompany']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        Organization Location:
                                        <input type="text" name="location" placeholder="e.g Lagos, Nigeria" value="<?php echo $acmt['acmtLocation']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        Start Year:
                                        <input type="number" name="start" placeholder="e.g 2005" value="<?php echo $acmt['acmtStart']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        End year: <br>
                                        <span style="color:red; font-size:12px"> (leave blank for current job) </span>
                                        <input type="number" name="end" placeholder="e.g 2010" value="<?php if($acmt['acmtEnd'] !== "Present"){ echo $acmt['acmtEnd']; } ?>" class="form-control">
                                    </p>
                                    <p>
                                        Position Held:
                                        <input type="text" name="position" value="<?php echo $acmt['acmtPosition']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        Job Description (150 characters):
                                        <textarea name="desc" class="form-control" style="height:150px" maxlength="150"><?php echo $acmt['acmtDesc']; ?></textarea>
                                    </p>
                                    <p>
                                    <input type="submit" name="upAcmt" class="btn btn-primary"  value="Update" />
                                    </p>
                                </form>
                            <?php } else { ?>
                                <form method="post" enctype="multipart/form-data" action="">
                                    <p>
                                        <input type="hidden" name="acmtID" value="<?php echo $acmt['acmtID']; ?>">
                                    </p>
                                    <p>
                                        Skill:
                                        <input type="text" name="skill" value="<?php echo $acmt['acmtCompany']; ?>" class="form-control" required>
                                    </p>
                                    <p>
                                        Skill Description (150 characters):
                                        <textarea name="desc" class="form-control" style="height:150px" maxlength="150"><?php echo $acmt['acmtDesc']; ?></textarea>
                                    </p>
                                    <p>
                                    <input type="submit" name="upExp" class="btn btn-primary"  value="Update" />
                                    </p>
                                </form>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="row">
                                <div class="col-12 eo-dark-bg" style="border-bottom:#333 thin solid">
                                    <div id="expertiseTitle" style="display:none"> EXPERTISE <button id="experienceBtn" class="btn btn-primary" style="padding:2px 10px"> Show Work Experiences </button> </div>
                                    <div id="experienceTitle" style="display:block"> WORKING EXPERIENCES <button id="expertiseBtn" class="btn btn-primary" style="padding:2px 10px"> Show Expertise </button> </div>
                                </div>
                                <div id="experienceDiv" class="col-12" style="display:block">
                                    <?php foreach(oAcmtType($conn,$officeID,"Experience") AS $acmt){ ?>
                                        <div class="row" style="border-bottom:#999 thin solid; padding-top:10px">
                                            <div class="col-sm-8">
                                                <b> <?php echo $acmt['acmtCompany'].", ".$acmt['acmtLocation']. "(".$acmt['acmtStart']."-".$acmt['acmtEnd'].")"; ?> </b>
                                                <p> <?php echo "<b>".$acmt['acmtPosition'].": </b> ".$acmt['acmtDesc']; ?> </p>
                                            </div>
                                            <div class="col-sm-4" align="center">
                                                <a href="?id=<?php echo $officeID; ?>&achievement=<?php echo $acmt['acmtID']; ?>" class="btn btn-black" style="padding: 2px 10px;"> <i class="fas fa-edit"></i> Edit </a>
                                                <a href="#" onclick="doDelete(<?php echo $officeID; ?>, <?php echo $acmt['acmtID']; ?>)" class="btn btn-danger" style="padding: 2px 10px; "> <i class="fas fa-trash"></i> Delete </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div id="expertiseDiv" class="col-12" style="display:none">
                                    <?php foreach(oAcmtType($conn,$officeID,"Expertise") AS $acmt){ ?>
                                        <div class="row" style="border-bottom:#999 thin solid; padding-top:10px">
                                            <div class="col-sm-8">
                                                <b> <?php echo $acmt['acmtCompany']; ?> </b>
                                                <p> <?php echo $acmt['acmtDesc']; ?> </p>
                                            </div>
                                            <div class="col-sm-4" align="center">
                                                <a href="?id=<?php echo $officeID; ?>&achievement=<?php echo $acmt['acmtID']; ?>" class="btn btn-black" style="padding: 2px 10px;"> <i class="fas fa-edit"></i> Edit </a>
                                                <a href="#" onclick="doDelete(<?php echo $officeID; ?>, <?php echo $acmt['acmtID']; ?>)" class="btn btn-danger" style="padding: 2px 10px; "> <i class="fas fa-trash"></i> Delete </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
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
        if (confirm('Are you sure you want to delete this achievement?')) {
            window.location = "achievements.php?id="+a+"&achievement="+e+"&cmd=delete";
        } else {
            console.log("closed");
        }
    }

    $("#addExperience").click(function(){
        $("#showExpertise").hide();
        $("#showExperience").slideToggle("slow");
    });

    $("#addExpertise").click(function(){
        $("#showExperience").hide();
        $("#showExpertise").slideToggle("slow");
    });

    $("#expertiseBtn").click(function(){
        $("#experienceTitle").hide();
        $("#experienceDiv").hide();
        $("#expertiseTitle").slideToggle("slow");
        $("#expertiseDiv").slideToggle("slow");
    });

    $("#experienceBtn").click(function(){
        $("#expertiseTitle").hide();
        $("#expertiseDiv").hide();
        $("#experienceTitle").slideToggle("slow");
        $("#experienceDiv").slideToggle("slow");
    });

    function closeAddAcmt(){
        $("#showExperience").hide();
        $("#showExpertise").hide();
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
