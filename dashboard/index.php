<?php
    include '../engine/conn.php';
    include '../engine/engine.php';
    if(isset($_SESSION['eo_user_session'])){ header("Location: home.php"); }
    if(isset($_POST['login'])){
        $signinq = $conn->prepare("SELECT * FROM users WHERE (uname = ? OR email = ?) and pword = ?");
        $signinq->execute(array($_POST['uname'], $_POST['uname'], md5($_POST['pword'])));
        $signinct = $signinq->rowCount();
        $signin = $signinq->fetch(PDO::FETCH_ASSOC);

        if($signinct == 1){
            $_SESSION['eo_user_session'] = $signin['userID'];
            header("Location: home.php");
        } else {
            echo "<script> alert('Incorrect Login Details!'); </script>";
        }
    }
?>

<!DOCTYPE html>
<html  >
<head>
    <title>Login | eOffice NG</title>
    <meta name="description" content="Setup your website or online store in minutes for as low as N1,000 with eoffice.ng. All you need to do is pick a name, select a template and edit it with your content.">
    <?php include 'includes/tags/header.php'; ?>
  
</head>
<body>
  
<?php include 'includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong>Welcome Back!</strong></h1>
                <p class="mbr-text mbr-fonts-style display-5">Login to your eOffice dashboard</p>
                <div class="row" style="margin-bottom:80px">
                    <div class="col-sm-4" align="center"></div>
                    <div class="col-sm-4" align="center">
                        <form method="post" action="">
                            <p>
                                <label> Username or Email </label>
                                <input type="text" name="uname" class="form-control" required />
                            </p>
                            <p>
                                <label> Password </label>
                                <input type="password" name="pword" class="form-control" required />
                            </p>
                            <button type="submit" name="login" class="btn btn-primary display-4 form-control" href="#">Login</button>
                        </form>
                        <p style="margin-top:30px"> Don't have an account yet? <a href="../get-started.php">Create Account</a> </p>
                    </div>
                    <div class="col-sm-4" align="center"></div>
                </div>
                <!-- <div class="image-wrap mt-4">
                    <img src="../assets/images/eoffice-home-1200x869.jpg" alt="eOffice Home Image" title="">
                </div> -->
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>


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
