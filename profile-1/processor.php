<?php 
    if(isset($_POST['updateTheme'])){
        $query = $conn->prepare("UPDATE profile1 SET headTitle=?, headSubTitle=?, headBtn1=?, headBtn2=?, summary=?, aboutTitle=?, aboutText=?, aboutBtn1=?, aboutBtn2=?, portfolioTitle=?, experienceTitle=?, expertiseTitle=?, contactTitle=?, contactSubTitle=?, contactEmail=?, contactPhone=?, lastModified=? WHERE officeID=?");
        $query->execute(array($_POST['headTitle'],$_POST['headSubtitle'],$_POST['headBtn1'],$_POST['headBtn2'],$_POST['summary'],$_POST['aboutTitle'],$_POST['aboutText'],$_POST['aboutBtn1'],$_POST['aboutBtn2'],$_POST['portfolioTitle'],$_POST['experienceTitle'],$_POST['expertiseTitle'],$_POST['contactTitle'],$_POST['contactSubTitle'],$_POST['contactEmail'],$_POST['contactPhone'],time(),$_GET['id']));
        if($query){
            if(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] !== ""){
                $imgName = "header";
                $dir = $siteData['officeDomain']."/";
                if(imgUpload($_FILES['file']['name'], $_FILES['file']['tmp_name'], $imgName, $dir) == 0){ 
                    $query2 = $conn->prepare("UPDATE profile1 SET headerBG=? WHERE officeID=?");
                    $query2->execute(array($_SESSION['UploadImgName'],$_GET['id']));
                    if($query2){ unset($_SESSION['UploadImgName']); }
                }
            }
            if(isset($_FILES["aboutImg"]["name"]) && $_FILES["aboutImg"]["name"] !== ""){
                $imgName = "about";
                $dir = $siteData['officeDomain']."/";
                if(galUpload($_FILES['aboutImg']['name'], $_FILES['aboutImg']['tmp_name'], $imgName, $dir) == 0){ 
                    $query3 = $conn->prepare("UPDATE profile1 SET aboutImg=? WHERE officeID=?");
                    $query3->execute(array($_SESSION['UploadImgName'],$_GET['id']));    
                    if($query3){ unset($_SESSION['UploadImgName']); }
                }
            }

            echo "<script> alert('Update successful'); window.location='template.php?id=".$_GET['id']."'; </script>";
        }
    }
?>