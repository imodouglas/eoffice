<?php 
    include 'conn.php';

    // Check Expired eOffices
    function chkExpiry($conn){
        $getOffice = $conn->prepare("SELECT * FROM offices a JOIN users b USING(userID) WHERE a.officeExpiry < ? AND a.officeStatus = ?");
        $getOffice->execute(array(time(), "published"));
        $offices = $getOffice->fetchAll();
        $officesct = $getOffice->rowCount();
        
        if($officesct > 0){
            foreach($offices AS $office){
                $doExp = $conn->prepare("UPDATE offices SET officeStatus = ? WHERE officeID = ?");
                $doExp->execute(array("unpublished", $office['officeID']));
                if($doExp){
                    $msg1 = "Hello ".$office['fname'].", \r\nThis is to notify you that your eOffice with address https://".$office['officeDomain'].".eoffice.ng has expired and has been unpublished. \r\n\r\nThis means your eoffice will no longer we accessible by the general public.\r\nTo renew it, login to your dashboard using this link www.eoffice.ng/dashboard. \r\n\r\nWe look forward to welcoming you back to the eoffice.ng family!\r\n\r\nWarm Regards!\r\neOffice NG Sales Team.";
                    mail ($office['email'], "Your eoffice ".$office['officeName']." has expired!", $msg1, "FROM: no-reply@oeffice.ng");
                }
            }
        }
    }


    // Check 30 days to go
    function chk30($conn){
        $getOffice = $conn->prepare("SELECT * FROM offices a JOIN users b USING(userID) WHERE a.officeExpiry < ? AND a.officeExpiry > ? AND a.officeStatus = ?");
        $now = time();
        $down = strtotime("+29 days", $now);
        $up = strtotime("+31 days", $now);
        $getOffice->execute(array($down, $up, "published"));
        $offices = $chk30q->fetchAll();
        $officesct = $chk30q->rowCount();
        
        if($officesct > 0){
            foreach($offices AS $office){
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <no-reply@eoffice.ng>' . "\r\n";

                $msg1 = "<html><body style='font-size:14px'> <p> <img src='https://eoffice.ng/assets/images/eoffice-expiration.jpg' style='width:100%' /> </p> <h2 align='center'> 30 days to go! </h2> <p> Hello ".$office['fname'].", </p><p> This is to notify you that your eOffice with address https://".$office['officeDomain'].".eoffice.ng will expire on ".date('d M, Y', $office['officeExpiry']).". </p> <p>This means your eoffice will be unpublished on the above date and will no longer we accessible by the general public.</p> <p>To renew it, please login to your dashboard using this link www.eoffice.ng/dashboard. </p> <p>We look forward to always serving you!</p> <p>Warm Regards! <br> eOffice NG Sales Team. </p> </body></html>";
                mail ($office['email'], $office['officeName']." expires in 30 days!", $msg1, $headers);
            }
        }
    }


    // Check 15 days to go
    function chk15($conn){
        $getOffice = $conn->prepare("SELECT * FROM offices a JOIN users b USING(userID) WHERE a.officeExpiry < ? AND a.officeExpiry > ? AND a.officeStatus = ?");
        $now = time();
        $down = strtotime("+14 days", $now);
        $up = strtotime("+16 days", $now);
        $getOffice->execute(array($down, $up, "published"));
        $offices = $chk30q->fetchAll();
        $officesct = $chk30q->rowCount();
        
        if($officesct > 0){
            foreach($offices AS $office){
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <no-reply@eoffice.ng>' . "\r\n";

                $msg1 = "<html><body style='font-size:14px'> <p> <img src='https://eoffice.ng/assets/images/eoffice-expiration.jpg' style='width:100%' /> </p> <h2 align='center'> 15 days to go! </h2> <p> Hello ".$office['fname'].", </p><p> This is to notify you that your eOffice with address https://".$office['officeDomain'].".eoffice.ng will expire on ".date('d M, Y', $office['officeExpiry']).". </p> <p>This means your eoffice will be unpublished on the above date and will no longer we accessible by the general public.</p> <p>To renew it, please login to your dashboard using this link www.eoffice.ng/dashboard. </p> <p>We look forward to always serving you!</p> <p>Warm Regards! <br> eOffice NG Sales Team. </p> </body></html>";
                mail ($office['email'], $office['officeName']." expires in 15 days!", $msg1, $headers);
            }
        }
    }


    // Check 7 days to go
    function chk7($conn){
        $getOffice = $conn->prepare("SELECT * FROM offices a JOIN users b USING(userID) WHERE a.officeExpiry < ? AND a.officeExpiry > ? AND a.officeStatus = ?");
        $now = time();
        $down = strtotime("+6 days", $now);
        $up = strtotime("+8 days", $now);
        $getOffice->execute(array($down, $up, "published"));
        $offices = $chk30q->fetchAll();
        $officesct = $chk30q->rowCount();
        
        if($officesct > 0){
            foreach($offices AS $office){
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <no-reply@eoffice.ng>' . "\r\n";

                $msg1 = "<html><body style='font-size:14px'> <p> <img src='https://eoffice.ng/assets/images/eoffice-expiration.jpg' style='width:100%' /> </p> <h2 align='center'> 7 days to go! </h2> <p> Hello ".$office['fname'].", </p><p> This is to notify you that your eOffice with address https://".$office['officeDomain'].".eoffice.ng will expire on ".date('d M, Y', $office['officeExpiry']).". </p> <p>This means your eoffice will be unpublished on the above date and will no longer we accessible by the general public.</p> <p>To renew it, please login to your dashboard using this link www.eoffice.ng/dashboard. </p> <p>We look forward to always serving you!</p> <p>Warm Regards! <br> eOffice NG Sales Team. </p> </body></html>";
                mail ($office['email'], $office['officeName']." expires in 7 days!", $msg1, $headers);
            }
        }
    }

    // Check 24 hours to go
    function chk1($conn){
        $getOffice = $conn->prepare("SELECT * FROM offices a JOIN users b USING(userID) WHERE a.officeExpiry < ? AND a.officeExpiry > ? AND a.officeStatus = ?");
        $now = time();
        $down = $now;
        $up = strtotime("+2 days", $now);
        $getOffice->execute(array($down, $up, "published"));
        $offices = $chk30q->fetchAll();
        $officesct = $chk30q->rowCount();
        
        if($officesct > 0){
            foreach($offices AS $office){
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <no-reply@eoffice.ng>' . "\r\n";

                $msg1 = "<html><body style='font-size:14px'> <p> <img src='https://eoffice.ng/assets/images/eoffice-expiration.jpg' style='width:100%' /> </p> <h2 align='center'> 1 day to go! </h2> <p> Hello ".$office['fname'].", </p><p> This is to notify you that your eOffice with address https://".$office['officeDomain'].".eoffice.ng will expire on ".date('d M, Y', $office['officeExpiry']).". </p> <p>This means your eoffice will be unpublished on the above date and will no longer we accessible by the general public.</p> <p>To renew it, please login to your dashboard using this link www.eoffice.ng/dashboard. </p> <p>We look forward to always serving you!</p> <p>Warm Regards! <br> eOffice NG Sales Team. </p> </body></html>";
                mail ($office['email'], $office['officeName']." expires in less than 24 hours!", $msg1, $headers);
            }
        }
    }
?>