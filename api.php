<?php
    include 'engine/conn.php';
    include 'engine/engine.php';

    if(isset($_GET['data'])){
        $decode = base64_decode($_GET['data']);
        $ndata = explode(',', $decode);

        $getUser = $conn->prepare("SELECT * FROM users WHERE uname=? AND pword=?");
        $getUser->execute(array($ndata[0],$ndata[1]));
        $userCount = $getUser->rowCount();
        if($userCount == 1){
            $userData = $getUser->fetch(PDO::FETCH_ASSOC);
            if(checkOffice($conn,$ndata[2],$userData['userID']) == 1){
                $result = siteData($conn,$ndata);
            } else { $result = "No data to retrieve"; }
        } else { $result = "No data to retrieve"; }
    } else { $result = "No data to retrieve"; }

    echo $result;
    
    
    
?>


