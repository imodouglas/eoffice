<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include 'conn.php';
    include 'engine.php';

    if(isset($_GET['cmd'],$_GET['eodomain']) && $_GET['cmd']=="checkdomain"){
        echo checkDomain($conn,$_GET['eodomain']);
    } 

    if(isset($_GET['cmd'],$_GET['eodomain']) && $_GET['cmd']=="setdomain"){
        $_SESSION['gsDomain'] = strtolower($_GET['eodomain']);
        echo 1;
    } 
    if(isset($_GET['cmd'],$_GET['eoplan']) && $_GET['cmd']=="setplan"){
        $_SESSION['gsPlan'] = $_GET['eoplan'];
        echo 1;
    }

    if(isset($_GET['cmd'],$_GET['eotheme']) && $_GET['cmd']=="settheme"){
        $_SESSION['gsTheme'] = $_GET['eotheme'];
        echo 1;
    }
    
    if(isset($_GET['cmd']) && $_GET['cmd']=="changeplan"){
        unset($_SESSION['gsPlan']);
        echo 1;
    }

    if(isset($_GET['cmd']) && $_GET['cmd']=="changedomain"){
        unset($_SESSION['gsDomain']);
        echo 1;
    }

    if(isset($_GET['cmd']) && $_GET['cmd']=="changetheme"){
        unset($_SESSION['gsTheme']);
        echo 1;
    }

    if(isset($_GET['cmd'],$_GET['userinfo']) && $_GET['cmd']=="checkuser"){
        $result = checkUser($conn,$_GET['userinfo']);
        echo $result;
    }

    if(isset($_GET['fname'],$_GET['uname'],$_GET['email'],$_GET['pword1'],$_GET['pword2'])){
        $result = createAccount($conn,$_GET['fname'],$_GET['uname'],$_GET['email'],$_GET['pword1'],$_GET['pword2']);
        if($result == 1){ 
            $msg1 = "Hello ".$_GET['fname']."! \r\nYour eoffice account has been created successfully. Feel free to login and edit your account to edit your eoffice. \r\n\r\nRegards!\r\neOffice Team!";
            $msg2 = "A new eOffice account has been created. \r\n\r\nRegards!\r\neOffice Team!";
            mail($_GET['email'], "Welcome to eOffice NG!", $msg1, "FROM: no-reply@eoffice.ng");
            mail("info@easywebsite.com.ng", "New eOffice NG account created!", $msg2, "FROM: info@eoffice.ng");
        }
        echo $result;
    }

    if(isset($_POST['uname'],$_POST['pword'])){
        $result = login($conn,$_POST['uname'],$_POST['pword']);
        echo $result;
    }

    if(isset($_POST['eoName'],$_POST['eoDesc'])){
        // $result = createOffice($conn,$_POST['eoName'],$_POST['eoDesc']);
        // echo $result;
        if(!is_dir("./".$_SESSION['gsDomain'])) { mkdir("./".$_SESSION['gsDomain']); }
        echo 0;
    }
 

    if(isset($_GET['get'], $_GET['eoid']) && $_GET['get'] == "sitedata"){
        $result = siteData($conn,$_GET['eoid']);
        echo json_encode($result);
    } 

    if(isset($_GET['get'], $_GET['uid']) && $_GET['get'] == "userdata"){
        $result = userData($conn,$_GET['uid']);
        echo json_encode($result);
    }

    if(isset($_GET['cmd'], $_GET['eoid']) && $_GET['cmd'] == "publish"){
        $result = publishOffice($conn,$_GET['eoid']);
        echo $result;
    }

    if(isset($_GET['cmd'], $_GET['id'], $_GET['dir']) && $_GET['cmd'] == "delimage"){
        $result = deleteImg($conn,$_GET['id'],$_GET['dir']);
        echo $result;
    }

    if(isset($_GET['get']) && $_GET['get'] == "wallet-balance"){
        $result = totalEarnings($conn,$_SESSION['eo_user_session'])['total'] - totalCashouts($conn,$_SESSION['eo_user_session'])['total'];
        echo $result;
    }

    if(isset($_POST['userID'], $_POST['coAmount'])){
        $result = initCashout($conn, $_POST['userID'], $_POST['coAmount'], "Cashout request by user!");
        echo $result;
    }
?>