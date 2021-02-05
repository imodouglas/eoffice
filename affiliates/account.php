<?php 
    include '../engine/conn.php';
    include '../engine/engine.php';

    if(isset($_SESSION['eo_user_session'])){ 
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo-only-128x97.png" type="image/x-icon">
  <meta name="description" content="eOffice Nigeria is an online business solution that helps give business owners an online representation of their business / brand. If you don't have an eOffice, then you are not ready for business.">
  
  <title>eOffice NG - Your office on the internet</title>
  <?php include '../dashboard/includes/tags/header.php'; ?>
  
</head>
<body>
  
    <?php include '../dashboard/includes/menu.php'; ?>

<section class="header6 cid-s5u5s3HuN0" id="header6-2">
    <div class="container-fluid" style="padding-bottom:40px">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-9">
                <div align="center">
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
                                <p> <b>Create An eOffice Account </b> </p>
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
            </div>
        </div>
    </div>
</section>


    <?php 
        include '../dashboard/includes/footer.php'; 
        include 'includes/js-includes.php'; 
    ?>
    
    <script>
        
        $("#officedomain").keyup(function(){
            var eodomain = $("#officedomain").val();
            var newString = eodomain.replace(/[^-A-Z0-9]+/ig, "");
            newString = newString.toLowerCase();
            $("#officedomain").val(newString);
        });

        $("#gsBtn").click(function(){
            console.log("done!");
            checkDomain($("#officedomain").val());
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
                    window.location="home.php";
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
                        window.location="home.php";
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
  
  
  <input name="animation" type="hidden">
  </body>
</html>