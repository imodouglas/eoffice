<?php 
    if(isset($_POST['updateTheme'])){
        if(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] !== ""){
            $imgName = "header";
            $dir = $siteData['officeDomain']."/";
            
            //If no errors registred, print the success message
            if(resizeImage($_FILES['file']['name'], $_FILES['file']['tmp_name'], $imgName, $dir) == 0)
            {
                $query = $conn->prepare("UPDATE business1 SET headTitle=?, headSubTitle=?, headerBG=?, headButton1=?, headButton2=?, aboutTitle=?, aboutSubTitle=?, aboutText=?, aboutButton1=?, aboutButton2=?, servicesTitle=?, servicesSubTitle=?, galleryTitle=?, contactusTitle=?, contactAddress=?, contactPhone=?, contactEmail=?, workHours=?, socialFacebook=?, socialTwitter=?, socialInstagram=?, socialLinkedin=?, lastModified=? WHERE officeID=?");
                $query->execute(array($_POST['headTitle'],$_POST['headSubtitle'],$_SESSION['UploadImgName'],$_POST['aboutButton1'],$_POST['contactButton1'],$_POST['aboutTitle'],$_POST['aboutSubtitle'],$_POST['aboutText'],$_POST['servicesButton1'],$_POST['contactButton2'],$_POST['servicesTitle'],$_POST['servicesSubtitle'],$_POST['galleryTitle'],$_POST['contactTitle'],$_POST['contactAddress'],$_POST['contactPhone'],$_POST['contactEmail'],$_POST['workHours'],$_POST['socialFacebook'],$_POST['socialTwitter'],$_POST['socialInstagram'],$_POST['socialLinkedin'],time(),$_GET['id']));
                if($query){
                    unset($_SESSION['UploadImgName']);
                    echo "<script> alert('Template updated successfully'); window.location='template.php?id=".$_GET['id']."'; </script>";
                } else {
                    echo "<script> alert('Error updating template'); </script>";
                }
            }
        } else {
            $query = $conn->prepare("UPDATE business1 SET headTitle=?, headSubTitle=?, headButton1=?, headButton2=?, aboutTitle=?, aboutSubTitle=?, aboutText=?, aboutButton1=?, aboutButton2=?, servicesTitle=?, servicesSubTitle=?, galleryTitle=?, contactusTitle=?, contactAddress=?, contactPhone=?, contactEmail=?, workHours=?, socialFacebook=?, socialTwitter=?, socialInstagram=?, socialLinkedin=?, lastModified=? WHERE officeID=?");
            $query->execute(array($_POST['headTitle'],$_POST['headSubtitle'],$_POST['aboutButton1'],$_POST['contactButton1'],$_POST['aboutTitle'],$_POST['aboutSubtitle'],$_POST['aboutText'],$_POST['servicesButton1'],$_POST['contactButton2'],$_POST['servicesTitle'],$_POST['servicesSubtitle'],$_POST['galleryTitle'],$_POST['contactTitle'],$_POST['contactAddress'],$_POST['contactPhone'],$_POST['contactEmail'],$_POST['workHours'],$_POST['socialFacebook'],$_POST['socialTwitter'],$_POST['socialInstagram'],$_POST['socialLinkedin'],time(),$_GET['id']));
            if($query){
                echo "<script> alert('Template updated successfully'); window.location='template.php?id=".$_GET['id']."'; </script>";
            } else {
                echo "<script> alert('Error updating template'); </script>";
            }
        }
    }
?>