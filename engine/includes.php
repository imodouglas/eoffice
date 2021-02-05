<?php
  include '../engine/conn.php';
  include '../engine/engine.php';

  if(isset($_GET['address'])){
    $qeo = $conn->prepare("SELECT * FROM offices WHERE officeDomain = ?");
    $qeo->execute(array($_GET['address']));
    $qres = $qeo->fetch(PDO::FETCH_ASSOC);
    $officeID = $qres['officeID'];
  }

  if(eovalidation($conn,$officeID) == 0){
      header("Location: ../");
  } else {

    // $json = file_get_contents("https://www.cloudflare.com/cdn-cgi/trace");

    //   $jsonData = json_decode($json);
    //   if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $json, $ip)){
    //     $ip_address = $ip[0];
    //   } else {
    //     $ip_address = "unknown";
    //   }
    $ip_address = $_SERVER['REMOTE_ADDR'];

    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    if(isMobile()){
        $userDevice = "Mobile";
    } else {
        $userDevice = "Desktop";
    }

    if(!isset($_SESSION['visited'])){
      addVisit($conn, $officeID, $ip_address, time(), $userDevice);
      $_SESSION['visited'] = $ip_address;
    }

    $siteData = siteData($conn, $officeID);
  }
?>
