var siteURL = "http://localhost/eoffice";

$(document).ready(function(){
    $("#pageLoading").fadeOut("fast");
});

function gsAnim1(){
    $("#gsBtn").hide();
    $("#gsLoading").show();
}

function gsAnim2(){
    $("#gsLoading").hide();
    $("#gsBtn").show();
}

function number_format(num)
  {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
  }

function checkDomain(x){
    gsAnim1();
    $("#domainError").html("");
    $.get(siteURL+"/engine/data.php?cmd=checkdomain&eodomain="+x, function(data){
        if(data == 1){
            $("#domainError").html("The address is already taken, please try another address!");
            gsAnim2();
        } else {
            $.get(siteURL+"/engine/data.php?cmd=setdomain&eodomain="+x, function(data){
                if(data == 1){ window.location = "get-started.php?section=plans"; } else {
                    $("#domainError").html("An error occured! Please try again.");
                }
            });
        }
    });
}

function setPlan(x){
    $.get(siteURL+"/engine/data.php?cmd=setplan&eoplan="+x, function(data){
        if(data == 1){ window.location = "?section=themes"; } else {
            $("#domainError").html("An error occured! Please try again.");
        }
    });
}

function setTheme(x){
    $.get(siteURL+"/engine/data.php?cmd=settheme&eotheme="+x, function(data){
        if(data == 1){ window.location = "?section=login"; } else {
            $("#domainError").html("An error occured! Please try again.");
        }
    });
}

function changePlan(){
    $.get(siteURL+"/engine/data.php?cmd=changeplan", function(data){
        if(data == 1){ window.location = "?section=plans"; } else {
            $("#domainError").html("An error occured! Please try again.");
        }
    });
}

function changeTheme(){
    $.get(siteURL+"/engine/data.php?cmd=changetheme", function(data){
        if(data == 1){ window.location = "?section=themes"; } else {
            $("#domainError").html("An error occured! Please try again.");
        }
    });
}

function changeDomain(){
    $.get(siteURL+"/engine/data.php?cmd=changedomain", function(data){
        if(data == 1){ window.location = "get-started.php"; } else {
            $("#domainError").html("An error occured! Please try again.");
        }
    });
}

function showLoading(){
    $("#showLoading").slideToggle("slow");
}

function doPublish(x){
    // showLoading(); 
    $.get(siteURL+"/engine/data.php?get=sitedata&eoid="+x, function(data){
        $("#publishInfo").slideToggle("fast");
        if(data.officeType == "Virtual Office"){ var amount = 1000; } else if(data.officeType == "Virtual Shop"){ var amount = 5000; }
        var pubData = "<p> <b> You are about to subscribe for a year suscription of "+data.officeType+" <br> ("+data.officeName+")</b> </p>";
        pubData += "<p> You'll have to pay a total amount of N"+number_format(amount)+"</p>";
        pubData += "<a href='#' class='btn btn-primary' style='padding:3px 10px' onclick='makePayment("+data.officeID+","+amount+")'> Pay Now </a>";
        $("#pubData").html(pubData);
    });
}

function makePayment(a,b){
    $.get(siteURL+"/engine/data.php?get=sitedata&eoid="+a, function(udata){
        $.get(siteURL+"/engine/data.php?get=userdata&uid="+udata.userID, function(edata){
            FlutterwaveCheckout({
                public_key: "FLWPUBK-c6d1febc7d481ccff2a866034adde047-X",
                tx_ref: Math.floor(Math.random() * 100000000),
                amount: b,
                currency: "NGN",
                country: "NG",
                // payment_options: "card,mobilemoney,ussd",
                customer: {
                  email: edata.email,
                //   phone_number: "08102909304",
                  name: edata.fname,
                },
                callback: function (pdata) { // specified callback function
                  if(pdata.status == "successful"){
                      $.get(siteURL+"/engine/data.php?cmd=publish&eoid="+udata.officeID, function(adata){
                        if(adata == 1){
                            var sucData = "<p> <i class='fas fa-thumbs-up' style='font-size:32px'></i> </p>";
                            sucData += "<p> <b>CONGRATULATIONS!</b> </p> <p> Your subscription was successful! </p>";
                            sucData += "<a href='home.php' class='btn btn-primary' style='padding:3px 10px'> Finish </a>";
                            $("#pubData").html(sucData);
                        }
                      });
                  }
                },
                customizations: {
                  title: "eOffice Subscription",
                  description: "Payment for 1 year subscription of "+udata.officeType+" for "+udata.officeName,
                  logo: siteURL+"/assets/images/logo-only-430x326.png",
                },
            });
        });
    });
}