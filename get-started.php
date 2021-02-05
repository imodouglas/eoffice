<?php 
    include 'engine/conn.php';
    include 'engine/engine.php';

    if(isset($_POST['eoName'],$_POST['eoDesc'])){
        $result = createOffice($conn,$_POST['eoName'],$_POST['eoDesc']);
        if($result == 0){
            echo "<script> alert('An error occured. Please try again!'); </script>";
        } else {
            header("Location: dashboard/template.php?id=".$result);
        }
    }
    
    if(isset($_POST['goto2'])){
        $domain = strtolower(preg_replace("/[^a-zA-Z]+/", "", $_POST['officedomain']));
        $result = checkDomain($conn,$domain);
        if($result == 0){
            $_SESSION['gsDomain'] = $domain;
            header("Location: get-started.php?step=2");
        } else {
            $err = "Sorry the name ".$domain.".eoffice.ng is already taken!";
        }
    }
    
    if(isset($_SESSION['gsDomain'], $_GET['step'], $_GET['plan']) && $_GET['step']==2 && $_GET['plan'] !== ""){
        if($_GET['plan'] == "office"){
            $_SESSION['gsPlan'] = "Virtual Office";
            header("Location: ?step=3");
        } else if($_GET['plan'] == "shop"){
            $_SESSION['gsPlan'] = "Virtual Shop";
            header("Location: ?step=3");
        }
    }
    
    if(isset($_SESSION['gsDomain'], $_SESSION['gsPlan'], $_GET['step'], $_GET['theme']) && $_GET['step']==3 && $_GET['theme'] !== ""){
        $_SESSION['gsTheme'] = $_GET['theme'];
        header("Location: ?step=4");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo-only-128x97.png" type="image/x-icon">
  <meta name="description" content="Setup your website or online store in minutes for as low as N1,000 with eoffice.ng. All you need to do is pick a name, select a template and edit it with your content.">
  
  <title>eOffice NG - Your office on the internet</title>
  <?php include 'includes/headtags.php'; ?>
  
</head>
<body>
  
    <?php include 'includes/header.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid" style="padding-bottom:40px">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <?php if(!isset($_SESSION['gsDomain'])){ ?>
                    <div id="chooseDomain">
                        <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1"><strong>Let's get started!</strong></h1>
                        <p class="mbr-text mbr-fonts-style display-5"> Choose an eOffice address </p>
                        <form method="post" action="">
                            <div align="center">
                                <div style="width:100%; max-width:600px!important">
                                    <div class="input-group mb-3">
                                        <input type="text" name="officedomain" class="form-control" placeholder="yourofficename" id="officedomain" aria-describedby="basic-addon1">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">.eoffice.ng</span>
                                        </div>
                                    </div>
                                    <div style="padding:10px; color:red" id="domainError"></div>
                                </div> 
                            </div>
                            <div class="mbr-section-btn mt-3">
                                <button type="submit" style="display:inline-block" name="goto2" class="btn btn-primary display-4" id="gsBtn0">Continue &nbsp;<i class="fas fa-arrow-circle-right"></i> </button>
                                <!--<button type="submit" name="goto2" class="btn btn-primary display-4" id="gsLoading" style="display:none"><i class="fas fa-spinner fa-spin"></i>&nbsp; Validating... </button>-->
                            </div>
                        </form>
                    </div>
                <?php } else if(isset($_SESSION['gsDomain']) && !isset($_SESSION['gsPlan'])){ ?>
                    <div align="center">
                        <p class="mbr-text mbr-fonts-style display-5" align="center"> Step 2/4: Select a plan </p>
                        <p> <?php echo $_SESSION['gsDomain']; ?> </p>
                        <p> <a href="#" onclick="changeDomain()"> <i class="fas fa-arrow-circle-left"></i> Change Address  </a> </p>
                        <div class="row" style="background:none;" align="center">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5" style="padding:20px">
                                <div class="eo-box-t p10">
                                    <div style="border-bottom:#333 thin solid; padding-bottom:20px; margin-bottom:20px">
                                        <h3> Virtual Office </h3>
                                        <h1> <b> N1,000<span style="font-size:24px">/Year</span> </b> </h1>
                                        <h4 style="color:#070; font-size:14px"> <b> First 30 days free! </b> </h4>
                                    </div>
                                    <div align="left" style="padding:10px">
                                        <i class="fas fa-caret-right"></i> eOffice Address (youraddress.eoffice.ng) <br />
                                        <i class="fas fa-caret-right"></i> Business biography <br />
                                        <i class="fas fa-caret-right"></i> Display your services <br />
                                        <i class="fas fa-caret-right"></i> Gallery/Portfolio <br />
                                        <i class="fas fa-caret-right"></i> Display contact information <br />
                                        <i class="fas fa-caret-right"></i> Direct WhatsApp chat
                                    </div>
                                    <div style="padding:10px">
                                        <!--<button class="btn btn-primary display-4" onclick="setPlan('Virtual Office')">Select Plan &nbsp;<i class="fas fa-arrow-circle-right"></i> </button>-->
                                        <a href="?step=2&plan=office" class="btn btn-primary display-4">Select Plan &nbsp;<i class="fas fa-arrow-circle-right"></i> </a>
                                        <p> <br> <a href="<?php echo $siteURL.'/dobemutilities'; ?>" target="_blank"> See Sample </a> </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-5" style="padding:20px">
                                <div class="eo-box-t p10">
                                    <div style="border-bottom:#333 thin solid; padding-bottom:20px; margin-bottom:20px">
                                        <h3> Virtual Shop </h3>
                                        <h1> <b> N5,000<span style="font-size:24px">/Year</span> </b> </h1>
                                        <h4 style="color:#070; font-size:14px"> <b> First 30 days free! </b> </h4>
                                    </div>
                                    <div align="left" style="padding:10px">
                                        <i class="fas fa-caret-right"></i> eOffice Address (youraddress.eoffice.ng) <br />
                                        <i class="fas fa-caret-right"></i> Shop brief  <br />
                                        <i class="fas fa-caret-right"></i> Display your products <br />
                                        <i class="fas fa-caret-right"></i> Order via WhatsApp <br />
                                        <i class="fas fa-caret-right"></i> Display contact information <br />
                                        <i class="fas fa-caret-right"></i> Direct WhatsApp chat
                                    </div>
                                    <div style="padding:10px">
                                        <!--<button class="btn btn-primary display-4"  onclick="setPlan('Virtual Shop')">Select Plan &nbsp;<i class="fas fa-arrow-circle-right"></i> </button>-->
                                        <a href="?step=2&plan=shop" class="btn btn-primary display-4">Select Plan &nbsp;<i class="fas fa-arrow-circle-right"></i> </a>
                                        <p> <br> <a href="<?php echo $siteURL.'/tiptopfoodhub'; ?>" target="_blank"> See Sample </a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div>
                <?php } else if(isset($_SESSION['gsDomain'], $_SESSION['gsPlan']) && !isset($_SESSION['gsTheme'])){ ?>
                    <div align="center">
                        <p class="mbr-text mbr-fonts-style display-5" align="center"> Step 3/4: Select a theme </p>
                        <p> <?php echo $_SESSION['gsDomain']; ?> &nbsp;<i class="fas fa-caret-right"></i> &nbsp;<?php echo $_SESSION['gsPlan']; ?>  </p>
                        <p> <a href="#" onclick="changePlan()"> <i class="fas fa-arrow-circle-left"></i> Change Plan  </a> </p>
                        <div class="row" style="background:none;" align="center">
                            <?php foreach(getThemesType($conn,$_SESSION['gsPlan'],"active") AS $theme){ ?>
                                <div class="col-sm-6 p10">
                                    <div class="p0">
                                        <img src="<?php echo $siteURL."/templates/".$theme['themeDir']."/screenshots/video.gif"; ?>" style="width:100% !important; border:#333 thin solid" />
                                        <div class="p10" align="center">
                                            <b> <?php echo strtoupper($theme['themeName']); ?> (<a href="templates/<?php echo $theme['themeDir']; ?>" target="_blank">Preview</a>) </b>
                                            <p> 
                                                <!--<button class="btn btn-primary display-4" onclick="setTheme('<?php echo $theme['themeID'] ?>')">Select Theme &nbsp;<i class="fas fa-arrow-circle-right"></i> </button> -->
                                                <a href="?step=3&theme=<?php echo $theme['themeID'] ?>" class="btn btn-primary display-4">Select Theme &nbsp;<i class="fas fa-arrow-circle-right"></i> </a> 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } else if(isset($_SESSION['gsDomain'], $_SESSION['gsPlan'], $_SESSION['gsTheme'])){ if(!isset($_SESSION['eo_user_session'])){ ?>
                    <div align="center">
                        <p class="mbr-text mbr-fonts-style display-5" align="center"> Step 4/4: Final Step! </p>
                        <p> <?php echo $_SESSION['gsDomain']; ?> &nbsp;<i class="fas fa-caret-right"></i> &nbsp;<?php echo $_SESSION['gsPlan']; ?> &nbsp;<i class="fas fa-caret-right"></i>&nbsp; <?php echo getTheme($conn,$_SESSION['gsTheme'])['themeName'] ?> </p>
                        <p> <a href="#" onclick="changeTheme()"> <i class="fas fa-arrow-circle-left"></i> Change Theme  </a> </p>
                        <div class="row" style="background:none; margin-top:40px" align="left">
                            <div class="col-sm-6 p20 eo-divider">
                                <form method="post" action="" id="loginForm">
                                    <p> <b>Login To Your Account </b> </p>
                                    <div style="color:red" id="loginError"></div>
                                    <p>
                                        <label> Username or Email </label>
                                        <input type="text" name="uname" class="form-control" required />
                                    </p>
                                    <p>
                                        <label> Password </label>
                                        <input type="password" name="pword" class="form-control" required />
                                    </p>
                                    <p>
                                        <button type="submit" name="login" class="btn btn-primary"> <span id="loginBtn"> Login </span>  </button>
                                    </p>
                                </form>
                            </div>
                            <div class="col-sm-6 p20">
                                <form method="post" action="" id="signupForm">
                                    <p> <b>Create An Account </b> </p>
                                    <div style="color:red" id="signupError"></div>
                                    <div style="color:red" id="unError"></div>
                                    <div style="color:red" id="emError"></div>
                                    <div style="color:red" id="pwError2"></div>
                                    <p style="margin-top:20px">
                                        <label> Full Name </label>
                                        <input type="text" name="fname" class="form-control" required />
                                    </p>
                                    <p>
                                        <label> Username </label>
                                        <input type="text" name="uname" id='uname' class="form-control" required />
                                    </p>
                                    <p>
                                        <label> Email </label>
                                        <input type="email" name="email" id="email" class="form-control" required />
                                    </p>
                                    <p>
                                        <label> Password </label>
                                        <input type="password" name="pword1" id="pword1" class="form-control" required />
                                    </p>
                                    <p>
                                        <label> Re-enter Password </label>
                                        <input type="password" name="pword2" id="pword2" class="form-control" required />
                                        <span style="color:red" id="pwError"></span>
                                    </p>
                                    <p>
                                        <button type="submit" name="signup" class="btn btn-primary"> <span id="signupBtn"> Create Account </span>  </button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } else {  ?>
                    <div align="center">
                        <p class="mbr-text mbr-fonts-style display-5" align="center"> Step 4/4: Final Step! </p>
                        <p> <?php echo $_SESSION['gsDomain']; ?> &nbsp;<i class="fas fa-caret-right"></i> &nbsp;<?php echo $_SESSION['gsPlan']; ?> &nbsp;<i class="fas fa-caret-right"></i>&nbsp; <?php echo getTheme($conn,$_SESSION['gsTheme'])['themeName'] ?> </p>
                        <p> <a href="#" onclick="changeTheme()"> <i class="fas fa-arrow-circle-left"></i> Change Theme  </a> </p>
                        <div class="row" style="background:none;" align="center">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 p20">
                                <form method="post" action="" id="abouteoForm">
                                    <p> <b>You're almost there! </b> </p>
                                    <div style="color:red" id="loginError"></div>
                                    <p>
                                        <label> Your eOffice Name: </label>
                                        <input type="text" name="eoName" class="form-control" placeholder="Enter you business name" required />
                                    </p>
                                    <p>
                                        <label> About Your eOffice: </label>
                                        <textarea class="form-control" name="eoDesc" id="eoDesc" style="height:100px" placeholder="Tell us about your business" maxlength="200" required></textarea>
                                        <div style="color:green; font-size:12px; margin-top:-10px"><span id="dchar">200</span> characters left</div>
                                    </p>
                                    <p>
                                        <button type="submit" name="finish" class="btn btn-primary"> <span id="loginBtn"> <i class="far fa-thumbs-up"></i>&nbsp; Finish </span>  </button>
                                    </p>
                                </form>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </div>
</section>


    <?php include 'includes/footer.php'; ?>
    
    <!--<script src="assets/web/assets/jquery/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="engine/js/script.js"></script>
    
    <script>
        
        // $("#officedomain").keyup(function(){
        //     var eodomain = $("#officedomain").val();
        //     var newString = eodomain.replace(/[^-A-Z0-9]+/ig, "");
        //     newString = newString.toLowerCase();
        //     $("#officedomain").val(newString);
        // });

        $("#gsBtn").click(function(){
            console.log("done!");
            var eodomain = $("#officedomain").val();
            var newString = eodomain.replace(/[^-A-Z0-9]+/ig, "");
            newString = newString.toLowerCase();
            checkDomain(newString);
        });

        $("#eoDesc").keyup(function(){
            var char = $("#eoDesc").val().length;
            var cleft = 200-char;
            $("#dchar").html(cleft);
        });

        $("#pword2").keyup(function(){
            $("#pwError").html("");
            if($("#pword1").val() !== $("#pword2").val()){
                $("#pwError").html("Password Mismatch");
            }
        });

        var unameData = 0;
            var emailData = 0;
            var suError = "";
        
        $("#loginForm").submit(function(e){
            e.preventDefault();
            var fvalues = $(this).serialize();
            $("#loginBtn").html("<i class='fas fa-spinner fa-spin'></i> Please wait...");
            $.post(siteURL+"/engine/data.php", fvalues, function(fdata){
                if(fdata > 0){
                    $("#loginBtn").html("Login");
                    window.location="?section=about-office";
                } else {
                    $("#loginError").html("Incorrect Login Details! Try again");
                    $("#loginBtn").html("Login");
                }
            });
        });

        $("#signupForm").submit(function(e){
            e.preventDefault();
            var fvalues = $(this).serialize();
            $.get(siteURL+"/engine/data.php?"+fvalues, function(fdata){
                    console.log(fdata);
                    if(fdata == 0){
                        $("#signupError").html("<div> An error occured </div>");
                        $("#signupBtn").html("Create Account");
                    } else {
                        $("#signupBtn").html("Create Account");
                        window.location="?section=about-office";
                    }
                });
                
            var uname = $("#uname").val();
            var email = $("#email").val();
            $("#pwError2").html("");
            $("#unError").html("");
            $("#emError").html("");
            $("#signupBtn").html("<i class='fas fa-spinner fa-spin'></i> Please wait...");

            console.log(fvalues);

            if($("#pword1").val() !== $("#pword2").val()){
                $("#pwError2").html("* Password Mismatch.");
            } else {
                $.get(siteURL+"/engine/data.php?cmd=checkuser&userinfo="+uname, function(udata){
                    if(udata > 0){
                        $("#unError").html("<div> * Username already exist. </div>");
                    }
                });

                $.get(siteURL+"/engine/data.php?cmd=checkuser&userinfo="+email, function(edata){
                    if(edata > 0){
                        $("#emError").html("<div> * Email already exist. </div>");
                    }
                });
            }
            
        });

        // $("#abouteoForm").submit(function(e){
        //     e.preventDefault();
        //     var fvalues = $(this).serialize();
        //     console.log(fvalues);
        //     $.post(siteURL+"/engine/data.php", fvalues, function(fdata){
        //         if(fdata > 0){
        //             window.location = "dashboard/template.php?id="+fdata;
        //         } else {
        //             alert("An error occured! Please try again.");
        //         }
        //     });
        // });


    </script>
    <?php include 'includes/js-include.php'; ?>
  
  
  <input name="animation" type="hidden">
  </body>
</html>