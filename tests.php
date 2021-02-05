<?php 
/**
    // if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    // {
    //   $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    // } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    // {
    //   $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    // } else {
    //     $ip_address = "unknown";
    // }

    // function isMobile() {
    //     return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    // }

    // if(isMobile()){
    //     $userDevice = "Mobile";
    // } else {
    //     $userDevice = "Desktop";
    // }
    
    $json = file_get_contents("https://www.cloudflare.com/cdn-cgi/trace");

      $jsonData = json_decode($json);
      if(preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $json, $ip)){
        $ip_address = $ip[0];
      }
      $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip_address)); 
      $country = $ipdat->geoplugin_countryName; 

      echo $country;
      // echo $_SERVER['REMOTE_ADDR'];
     **/

echo date("d M, Y", strtotime(date("Y-m-d") . " -1 month"));
?>