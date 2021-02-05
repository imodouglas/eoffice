<?php
  $siteURL = "http://localhost/eoffice";

  function login($conn,$uname,$pword){
    $signinq = $conn->prepare("SELECT * FROM users WHERE (uname = ? OR email = ?) and pword = ?");
    $signinq->execute(array($uname, $uname, md5($pword)));
    $check = $signinq->rowCount();
    if($check == 1){
      $signin = $signinq->fetch(PDO::FETCH_ASSOC);
      $result = $signin['userID'];
      $_SESSION['eo_user_session'] = $result;
    } else {
      $result = 0;
    }
    return $result;
  }

  function userData ($conn,$userID){
    $query = $conn->prepare("SELECT * FROM users where userID = ?");
    $query->execute(array($userID));
    // $getCategoriesct = $getCategoriesq->rowCount();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function checkUser($conn, $userInfo){
    $query = $conn->prepare("SELECT * FROM users WHERE userID = ? OR uname = ? OR email = ?");
    $query->execute(array($userInfo,$userInfo,$userInfo));
    $result = $query->rowCount();
    return $result;
  }

  function createAccount($conn,$fname,$uname,$email,$pword1,$pword2){
    if($pword1 == $pword2){
      $oldID = $conn->lastInsertId();
      $query = $conn->prepare("INSERT INTO users (fname,uname,email,pword,regTime) VALUES (?,?,?,?,?)");
      $query->execute(array($fname,$uname,$email,md5($pword1), time()));
      if($oldID !== $conn->lastInsertId()){
        $_SESSION['eo_user_session'] = $conn->lastInsertId();
        $result = 1;
      } else {
        $result = 0;
      }
    } else {
      $result = 0;
    }
    
    return $result;
  }

  function siteData ($conn,$officeID){
    $gtq = $conn->prepare("SELECT themeTable FROM offices a JOIN themes b USING(themeID) WHERE a.officeID = ?");
    $gtq->execute(array($officeID));
    $gt = $gtq->fetch(PDO::FETCH_ASSOC);
    $tt = $gt['themeTable'];
    $query = $conn->prepare("SELECT * FROM offices a JOIN settings b USING (officeID) JOIN ".$tt." c USING (officeID) JOIN theme_settings d USING(templateName) where a.officeID = ?");
    $query->execute(array($officeID));
    // $getCategoriesct = $getCategoriesq->rowCount();
    $result = $query->fetch(PDO::FETCH_ASSOC); 
    return $result;
  }

  function addVisit($conn, $officeID, $visitorIP, $visitTime, $visitDevice){
    $query = $conn->prepare("INSERT INTO visits (officeID, visitorIP, visitTime, visitorDevice) VALUES (?,?,?,?)");
    $query->execute(array($officeID, $visitorIP, $visitTime, $visitDevice));
    if($query){
      $result = 1;
    } else {
      $result = 0;
    }
  }

  function visitCount($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM visits WHERE officeID = ?");
    $query->execute(array($officeID));
    $result = $query->rowCount();
    return $result;
  }
  
  function visitCountMonth($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM visits WHERE officeID = ? AND (visitTime BETWEEN ? AND ?)");
    $query->execute(array($officeID, strtotime(date("Y-m-d") . " -1 month"), time()));
    $result = $query->rowCount();
    return $result;
  }

  function visitData($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM visits WHERE officeID = ? ORDER BY visitID DESC");
    $query->execute(array($officeID));
    $result = $query->fetchAll();
    return $result;
  }
  
  function visitDataMonth($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM visits WHERE officeID = ? AND (visitTime BETWEEN ? AND ?) ORDER BY visitID DESC");
    $query->execute(array($officeID, strtotime(date("Y-m-d") . " -1 month"), time()));
    $result = $query->fetchAll();
    return $result;
  }

  function checkDomain ($conn,$eoDomain){
    $domains = array("subdomain", "business-1", "profile-1", "shop-1", "templates", "cojasa93", "assets", "affiliates", "marketplace", "dashboard", "includes", "templates", "engine");
    if(in_array($eoDomain, $domains)){
        $result = 1;
    } else {
        $query = $conn->prepare("SELECT * FROM offices where officeDomain = ?");
        $query->execute(array(strtolower($eoDomain)));
        $result = $query->rowCount();   
    }
    return $result;
  }

  function getThemesType($conn,$themeType,$themeStatus){
    $query = $conn->prepare("SELECT * FROM themes WHERE themeType = ? and themeStatus = ? ORDER BY themeName DESC");
    $query->execute(array($themeType,$themeStatus));
    $result = $query->fetchAll();
    return $result;
  }

  function getTheme($conn,$themeID){
    $query = $conn->prepare("SELECT * FROM themes WHERE themeID = ?");
    $query->execute(array($themeID));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function oCats ($conn,$officeID){
    $getCategoriesq = $conn->prepare("SELECT * FROM categories where officeID = ?");
    $getCategoriesq->execute(array($officeID));
    // $getCategoriesct = $getCategoriesq->rowCount();
    $getCategories = $getCategoriesq->fetchAll();
    return $getCategories;
  }

  function oCatsct ($conn,$officeID){
    $getCategoriesq = $conn->prepare("SELECT * FROM categories where officeID = ?");
    $getCategoriesq->execute(array($officeID));
    $getCategories = $getCategoriesq->rowCount();
    // $getCategories = $getCategoriesq->fetchAll();
    return $getCategories;
  }
 
  function createOffice($conn,$officeName,$officeDesc){
    if(isset($_SESSION['gsDomain'], $_SESSION['gsPlan'], $_SESSION['gsTheme'], $_SESSION['eo_user_session'])){
      if(!isset($_SESSION['eo_refID'])){ $refID = 0; } else { $refID = $_SESSION['eo_refID']; }
      $oquery = $conn->prepare("INSERT INTO offices (userID,themeID,refID,officeName,officeDomain,officeDesc,officeType,officeCreated,officeExpiry,officeStatus) VALUES (?,?,?,?,?,?,?,?,?,?)");
      $oquery->execute(array($_SESSION['eo_user_session'],$_SESSION['gsTheme'],$refID,$officeName,$_SESSION['gsDomain'],$officeDesc,$_SESSION['gsPlan'],time(),strtotime("+30 days", time()),"published"));
      $officeID = $conn->lastInsertId();
      $squery = $conn->prepare("INSERT INTO settings (officeID) VALUES (?)");
      $squery->execute(array($officeID));
      $gtQuery = $conn->prepare("SELECT * FROM themes WHERE themeID = ?");
      $gtQuery->execute(array($_SESSION['gsTheme']));
      $gtResult = $gtQuery->fetch(PDO::FETCH_ASSOC);
      $tTable = $gtResult['themeTable'];
      $tquery = $conn->prepare("INSERT INTO $tTable (officeID) VALUES (?)");
      $tquery->execute(array($officeID));
      if($oquery && $squery && $tquery){
        if(!is_dir($_SESSION['gsDomain'])){ mkdir($_SESSION['gsDomain']); }
        $file = $_SESSION['gsDomain']."/index.php";
        // $index = fopen($file, "w");
        $content = '<?php  $officeID = '.$officeID.'; include "../engine/includes.php"; include "../".$siteData["templateDir"]."/ext-includes/content.php";';
        // $content = "This is a test...";
        file_put_contents($file, $content);
        // fclose($index);
        unset($_SESSION['gsDomain'], $_SESSION['gsPlan'], $_SESSION['gsTheme']);
        $result = $officeID;
      } else {
        $result = 0;
      }
    } else {
      $result = 0;
    }
    return $result;
  }

  function oOffices ($conn,$userID){
    $query = $conn->prepare("SELECT * FROM offices where userID = ?");
    $query->execute(array($userID));
    // $getCategoriesct = $getCategoriesq->rowCount();
    $result = $query->fetchAll();
    return $result;
  }
  
  function getOffice ($conn,$officeID){
    $query = $conn->prepare("SELECT * FROM offices where officeID = ?");
    $query->execute(array($officeID));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function oOfficesct ($conn,$userID){
    $query = $conn->prepare("SELECT * FROM offices where userID = ?");
    $query->execute(array($userID));
    // $getCategoriesct = $getCategoriesq->rowCount();
    $result = $query->rowCount();
    return $result;
  }

  function checkOffice ($conn,$officeID,$userID){
    $query = $conn->prepare("SELECT * FROM offices where officeID = ? AND userID = ?");
    $query->execute(array($officeID, $userID));
    // $getCategoriesct = $getCategoriesq->rowCount();
    $result = $query->rowCount();
    return $result;
  }

  function allOfficesType ($conn,$status){
    $query = $conn->prepare("SELECT * FROM offices where officeStatus = ?");
    $query->execute(array($status));
    $result = $query->fetchAll();
    return $result;
  } 

  function oProducts($conn,$officeID){
    $getproductsq = $conn->prepare("SELECT * FROM products where officeID=?");
    $getproductsq->execute(array($officeID));
    // $getproductsct = $getproductsq->rowCount();
    $getproducts = $getproductsq->fetchAll();
    return $getproducts;
  }

  function oProductsct($conn,$officeID){
    $getproductsq = $conn->prepare("SELECT * FROM products where officeID=?");
    $getproductsq->execute(array($officeID));
    $getproducts = $getproductsq->rowCount();
    // $getproducts = $getproductsq->fetchAll();
    return $getproducts;
  }

  function oServices($conn,$officeID){
    $getproductsq = $conn->prepare("SELECT * FROM services where officeID=?");
    $getproductsq->execute(array($officeID));
    // $getproductsct = $getproductsq->rowCount();
    $getproducts = $getproductsq->fetchAll();
    return $getproducts;
  }

  function oServicesct($conn,$officeID){
    $getproductsq = $conn->prepare("SELECT * FROM services where officeID=?");
    $getproductsq->execute(array($officeID));
    $getproducts = $getproductsq->rowCount();
    // $getproducts = $getproductsq->fetchAll();
    return $getproducts;
  }

  function getPortfolio($conn,$pid){
    $query = $conn->prepare("SELECT * FROM portfolio where portfolioID=?");
    $query->execute(array($pid));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function oPortfolio($conn,$officeID){
    $query = $conn->prepare("SELECT * FROM portfolio where officeID=?");
    $query->execute(array($officeID));
    $result = $query->fetchAll();
    return $result;
  }

  function oPortfolioct($conn,$officeID){
    $query = $conn->prepare("SELECT * FROM portfolio where officeID=?");
    $query->execute(array($officeID));
    $result = $query->rowCount();
    return $result;
  }

  function getAcmt($conn,$aid){
    $query = $conn->prepare("SELECT * FROM achievements where acmtID=?");
    $query->execute(array($aid));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function oAcmt($conn,$officeID){
    $query = $conn->prepare("SELECT * FROM achievements where officeID=?");
    $query->execute(array($officeID));
    $result = $query->fetchAll();
    return $result;
  }

  function oAcmtct($conn,$officeID){
    $query = $conn->prepare("SELECT * FROM achievements where officeID=?");
    $query->execute(array($officeID));
    $result = $query->rowCount();
    return $result;
  }

  function oAcmtType($conn,$officeID,$type){
    $query = $conn->prepare("SELECT * FROM achievements where officeID=? AND acmtType=?");
    $query->execute(array($officeID,$type));
    $result = $query->fetchAll();
    return $result;
  }

  function oSettings($conn, $officeID){
    $Optionsq = $conn->prepare("SELECT * FROM settings WHERE officeID = ?");
    $Optionsq->execute(array($officeID));
    $Options = $Optionsq->fetch(PDO::FETCH_ASSOC);
  }

  function editCat($conn, $catName, $catID){
    $editCat = $conn->prepare("UPDATE categories SET catName = ? WHERE catID = ?");
    $editCat->execute(array($catName, $catID));
    if($editCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function editOption($conn, $officeName, $officeDesc, $phone, $whatsapp, $showPrice, $officeID){
    $editCat = $conn->prepare("UPDATE settings SET phoneNo = ?, defText = ?, showPrices = ? WHERE officeID = ?");
    $editCat->execute(array($phone, $whatsapp, $showPrice, $officeID));
    if($editCat){
      $editOffice = $conn->prepare("UPDATE offices SET officeName = ?, officeDesc = ? WHERE officeID = ?");
      $editOffice->execute(array($officeName, $officeDesc, $officeID));
      if($editOffice){
        $result = 1;
      } else {
        $result = 0;
      }  
    } 
    return $result;
  }

  function updateLogo($conn, $officeID, $logo){
    $editOffice = $conn->prepare("UPDATE offices SET officeLogo = ? WHERE officeID = ?");
    $editOffice->execute(array($logo, $officeID));
    if($editOffice){ $result = 1; } else { $result = 0; }
    return $result;
  }

  function refOffices($conn,$userID){
    $query = $conn->prepare("SELECT * FROM offices where refID = ?");
    $query->execute(array($userID));
    $result = $query->fetchAll();
    return $result;
  }

  function refOfficesct($conn,$userID){
    $query = $conn->prepare("SELECT * FROM offices where refID = ?");
    $query->execute(array($userID));
    $result = $query->rowCount();
    return $result;
  }

  function refOfficesType($conn,$userID,$status){
    $query = $conn->prepare("SELECT * FROM offices where refID = ? AND officeStatus = ?");
    $query->execute(array($userID,$status));
    $result = $query->fetchAll();
    return $result;
  }

  function refOfficesTypect($conn,$userID,$status){
    $query = $conn->prepare("SELECT * FROM offices where refID = ? AND officeStatus = ?");
    $query->execute(array($userID,$status));
    $result = $query->rowCount();
    return $result;
  }

  function getWallet($conn,$userID){
    $query = $conn->prepare("SELECT * FROM wallets WHERE userID = ?");
    $query->execute(array($userID));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function getWalletct($conn,$userID){
    $query = $conn->prepare("SELECT * FROM wallets WHERE userID = ?");
    $query->execute(array($userID));
    $result = $query->rowCount();
    return $result;
  }

  function addWallet($conn,$userID,$bank,$name,$account){
    $query = $conn->prepare("INSERT INTO wallets (userID,bankName,accountName,accountNo,walletStatus) VALUES (?,?,?,?,?)");
    $query->execute(array($userID,$bank,$name,$account,"active"));
    if($query){ $result = 1; } else { $result = 0; }
    return $result;
  }

  function upWallet($conn,$userID,$bank,$name,$account){
    $query = $conn->prepare("UPDATE wallets SET bankName=?,accountName=?,accountNo=? WHERE userID = ?");
    $query->execute(array($bank,$name,$account,$userID));
    if($query){ $result = 1; } else { $result = 0; }
    return $result;
  }

  function getEarnings($conn,$userID){
    $query = $conn->prepare("SELECT * FROM earnings WHERE userID = ? ORDER BY earningID DESC");
    $query->execute(array($userID));
    $result = $query->fetchAll();
    return $result;
  }

  function getEarningsct($conn,$userID){
    $query = $conn->prepare("SELECT * FROM earnings WHERE userID = ?");
    $query->execute(array($userID));
    $result = $query->rowCount();
    return $result;
  }

  function totalEarnings($conn,$userID){
    $query = $conn->prepare("SELECT SUM(earningAmount) AS total FROM earnings WHERE userID = ?");
    $query->execute(array($userID));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function addEarning($conn,$userID,$desc,$amount){
    $query = $conn->prepare("INSERT INTO earnings (userID,earningDesc,earningAmount,earningTime) VALUES (?,?,?,?)");
    $query->execute(array($userID,$desc,$amount,time()));
    if($query){ $result = 1; } else { $result = 0; }
    return $result;
  }

  function getCashouts($conn,$userID){
    $query = $conn->prepare("SELECT * FROM cashouts WHERE userID = ? ORDER BY cashoutID DESC");
    $query->execute(array($userID));
    $result = $query->fetchAll();
    return $result;
  }

  function getCashoutsct($conn,$userID){
    $query = $conn->prepare("SELECT * FROM cashouts WHERE userID = ?");
    $query->execute(array($userID));
    $result = $query->rowCount();
    return $result;
  }

  function totalCashouts($conn,$userID){
    $query = $conn->prepare("SELECT SUM(cashoutAmount) AS total FROM cashouts WHERE userID = ?");
    $query->execute(array($userID));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function initCashout($conn,$userID,$amount,$desc){
    $query = $conn->prepare("INSERT INTO cashouts (userID,cashoutAmount,cashoutDesc,cashoutTime,cashoutStatus) VALUES (?,?,?,?,?)");
    $query->execute(array($userID,$amount,$desc,time(),"pending"));
    if($query){ $result = 1; } else { $result = 0; }
    return $result;
  }

  function deleteCat($conn, $catID){
    $delCat = $conn->prepare("DELETE FROM categories WHERE catID = ?");
    $delCat->execute(array($catID));
    if($delCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function addCat($conn, $catName){
    $addCat = $conn->prepare("INSERT INTO categories (catName, catTime) VALUES (?,?)");
    $addCat->execute(array($catName, time()));
    if($addCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function eovalidation($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM offices where officeID = ? AND officeStatus = ?");
    $query->execute(array($officeID, "published"));
    $result = $query->rowCount();
    return $result;
  }

  function getProduct($conn,$productID){
    $query = $conn->prepare("SELECT * FROM products WHERE productID=?");
    $query->execute(array($productID));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  function updateProducts($conn, $productName, $productDesc, $productPrice, $productStatus, $productID){
    $editCat = $conn->prepare("UPDATE products SET productName = ?, productDesc=?, productPrice = ?, productStatus = ? WHERE productID = ?");
    $editCat->execute(array($productName, $productDesc, $productPrice, $productStatus, $productID));
    if($editCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function updateProducts2($conn, $productName, $productDesc, $productPrice, $productPhoto, $productStatus, $productID){
    $editCat = $conn->prepare("UPDATE products SET productName = ?, productDesc=?, productPrice = ?, productPhoto = ?, productStatus = ? WHERE productID = ?");
    $editCat->execute(array($productName, $productDesc, $productPrice, $productPhoto, $productStatus, $productID));
    if($editCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function updateServices($conn, $productName, $productDesc, $productID){
    $editCat = $conn->prepare("UPDATE services SET serviceName = ?, serviceDesc=? WHERE serviceID = ?");
    $editCat->execute(array($productName, $productDesc, $productID));
    if($editCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function updateServices2($conn, $productName, $productDesc, $productPhoto, $productID){
    $editCat = $conn->prepare("UPDATE services SET serviceName = ?, serviceDesc=?, serviceImage = ? WHERE serviceID = ?");
    $editCat->execute(array($productName, $productDesc, $productPhoto, $productID));
    if($editCat){
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function resizeImage($inputName, $inputTmp, $randImage, $dir){
    error_reporting(0);

            $change="";
            $abc="";

            define ("MAX_SIZE","9000");
            function getExtension($str) {
                    $i = strrpos($str,".");
                    if (!$i) { return ""; }
                    $l = strlen($str) - $i;
                    $ext = substr($str,$i+1,$l);
                    return $ext;
            }

            $errors=0;

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $image = $inputName;
                $uploadedfile = $inputTmp;


                if ($image)
                {

                    $filename = stripslashes($inputName);

                    $extension = getExtension($filename);
                    $extension = strtolower($extension);


            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
                    {

                        $change='<div class="msgdiv">Unknown Image extension </div> ';
                        $errors=1;
                    }
                    else
                    {

            $size=filesize($inputTmp);


            if ($size > MAX_SIZE*1024)
            {
                $change='<div class="msgdiv">You have exceeded the size limit!</div> ';
                $errors=1;
            }


            if($extension=="jpg" || $extension=="jpeg" )
            {
            $uploadedfile = $inputTmp;
            $src = imagecreatefromjpeg($uploadedfile);

            }
            else if($extension=="png")
            {
            $uploadedfile = $inputTmp;
            $src = imagecreatefrompng($uploadedfile);

            }
            else
            {
            $src = imagecreatefromgif($uploadedfile);
            }

            echo $scr;

            list($width,$height)=getimagesize($uploadedfile);


            $newwidth=400;
            $newheight=($height/$width)*$newwidth;
            $tmp=imagecreatetruecolor($newwidth,$newheight);


            $newwidth1=200;
            $newheight1=($height/$width)*$newwidth1;
            $tmp1=imagecreatetruecolor($newwidth1,$newheight1);

            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

            imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

            //$randImage = time().rand(1111,9999);
            $filename = "../".$dir. $randImage.".".$extension;
            $newfilename = $dir. $randImage.".".$extension;

            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }

            $_SESSION['UploadImgName'] = $newfilename;

            imagejpeg($tmp,$filename,100);

            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            }}

            }

            return $errors;
  }

  function imgUpload($inputName, $inputTmp, $randImage, $dir){
    error_reporting(0);

            $change="";
            $abc="";

            define ("MAX_SIZE","3200");
            function getExtension($str) {
                    $i = strrpos($str,".");
                    if (!$i) { return ""; }
                    $l = strlen($str) - $i;
                    $ext = substr($str,$i+1,$l);
                    return $ext;
            }

            $errors=0;

            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $image = $inputName;
                $uploadedfile = $inputTmp;


                if ($image)
                {

                    $filename = stripslashes($inputName);

                    $extension = getExtension($filename);
                    $extension = strtolower($extension);


            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
                    {

                        $change='<div class="msgdiv">Unknown Image extension </div> ';
                        $errors=1;
                    }
                    else
                    {

            $size=filesize($inputTmp);


            if ($size > MAX_SIZE*1024)
            {
                $change='<div class="msgdiv">You have exceeded the size limit!</div> ';
                $errors=1;
            }


            if($extension=="jpg" || $extension=="jpeg" )
            {
            $uploadedfile = $inputTmp;
            $src = imagecreatefromjpeg($uploadedfile);

            }
            else if($extension=="png")
            {
            $uploadedfile = $inputTmp;
            $src = imagecreatefrompng($uploadedfile);

            }
            else
            {
            $src = imagecreatefromgif($uploadedfile);
            }

            echo $scr;

            list($width,$height)=getimagesize($uploadedfile);


            $newwidth=1200;
            $newheight=($height/$width)*$newwidth;
            $tmp=imagecreatetruecolor($newwidth,$newheight);


            $newwidth1=200;
            $newheight1=($height/$width)*$newwidth1;
            $tmp1=imagecreatetruecolor($newwidth1,$newheight1);

            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

            imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

            //$randImage = time().rand(1111,9999);
            $filename = "../".$dir. $randImage.".".$extension;
            $newfilename = $dir. $randImage.".".$extension;

            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }

            $_SESSION['UploadImgName'] = $newfilename;

            imagejpeg($tmp,$filename,100);

            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            }}

            }

            return $errors;
  }

  function galUpload($inputName, $inputTmp, $randImage, $dir){
    error_reporting(0);

            $change="";
            $abc="";
            
            if(defined("MAX_SIZE")){} else { define ("MAX_SIZE","9000"); }
            

            $errors=0;

            
                $image = $inputName;
                $uploadedfile = $inputTmp;


                if ($image)
                {

                    $filename = stripslashes($inputName);

                    $extension = getExtension($filename);
                    $extension = strtolower($extension);


            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
                    {

                        $change='<div class="msgdiv">Unknown Image extension </div> ';
                        $errors=1;
                    }
                    else
                    {

            $size=filesize($inputTmp);


            if ($size > MAX_SIZE*1024)
            {
                $change='<div class="msgdiv">You have exceeded the size limit!</div> ';
                $errors=1;
            }


            if($extension=="jpg" || $extension=="jpeg" )
            {
            $uploadedfile = $inputTmp;
            $src = imagecreatefromjpeg($uploadedfile);

            }
            else if($extension=="png")
            {
            $uploadedfile = $inputTmp;
            $src = imagecreatefrompng($uploadedfile);

            }
            else
            {
            $src = imagecreatefromgif($uploadedfile);
            }

            echo $scr;

            list($width,$height)=getimagesize($uploadedfile);


            $newwidth=400;
            $newheight=($height/$width)*$newwidth;
            $tmp=imagecreatetruecolor($newwidth,$newheight);


            $newwidth1=200;
            $newheight1=($height/$width)*$newwidth1;
            $tmp1=imagecreatetruecolor($newwidth1,$newheight1);

            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

            imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

            //$randImage = time().rand(1111,9999);
            $filename = "../".$dir. $randImage.".".$extension;
            $newfilename = $dir. $randImage.".".$extension;

            if (session_status() == PHP_SESSION_NONE) {
              session_start();
            }

            $_SESSION['UploadImgName'] = $newfilename;

            imagejpeg($tmp,$filename,100);

            imagedestroy($src);
            imagedestroy($tmp);
            imagedestroy($tmp1);
            }}

            

            return $errors;
  }
  

  function getGallery($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM gallery WHERE officeID = ?");
    $query->execute(array($officeID));
    $result = $query->fetchAll();
    return $result;    
  }

  function getGalleryct($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM gallery WHERE officeID = ?");
    $query->execute(array($officeID));
    $result = $query->rowCount();
    return $result;    
  }

  function addGallery($conn, $officeID, $image){
    $query = $conn->prepare("INSERT INTO gallery (officeID,gImage,gImageAdded) VALUES (?,?,?)");
    $query->execute(array($officeID, $image, time()));
    if($query){ $result = 1; } else { $result = 0; }
    return $result;
  }

  function deleteImg($conn,$imgID,$imgdir){
    $q1 = $conn->prepare("SELECT * FROM gallery WHERE gImageID=?");
    $q1->execute(array($imgID));
    $qq = $q1->fetch(PDO::FETCH_ASSOC);
    $query = $conn->prepare("DELETE FROM gallery WHERE gImageID = ?");
    $query->execute(array($imgID));
    unlink("../".$qq['gImage']);
    $result = 1;
    
    return $result;
  }

  function getServices($conn, $officeID){
    $query = $conn->prepare("SELECT * FROM services WHERE officeID = ?");
    $query->execute(array($officeID));
    $result = $query->fetchAll();
    return $result;    
  }

  function publishOffice($conn, $officeID){
    $query = $conn->prepare("UPDATE offices SET officeStatus=?, officeCreated=?, officeExpiry=? WHERE officeID=?");
    $query->execute(array("published", time(), strtotime(date("Y-m-d") . " + 1 year"), $officeID));
    $ref = getOffice($conn,$officeID);
    if($query){
      if($ref['refID'] > 0){
        if($ref['officeType'] == "Virtual Shop"){ $amt = 1000; } else if($ref['officeType'] == "Virtual Office"){ $amt = 300; }
        addEarning($conn, $ref['userID'], $ref['officeType']." Referral Bonus", $amt);
      }
      $result = 1;
    } else {
      $result = 0;
    }
    return $result;
  }

  function cleanURL($url){
    $data = explode("http://", $url);
    $data = implode("",$data);
    $data = explode("https://", $url);
    $data = implode("",$data);
    $result = "http://".$data;
    return $result;
  }

  function cleanVURL($url){
    $data = explode("watch?v=", $url);
    $data = implode("embed/", $data);
    return $data;
  }
?>
