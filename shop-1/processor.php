<?php 
    if(isset($_POST['updateTheme'])){
        if(isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] !== ""){
            $imgName = time().rand(1111,9999);
            $dir = "assets/images/backgrounds/";
            
            //If no errors registred, print the success message
            if(resizeImage($_FILES['file']['name'], $_FILES['file']['tmp_name'], $imgName, $dir) == 0)
            {
                $query = $conn->prepare("UPDATE shop1 SET headTitle=?, headSubtitle=?, headImage=?, middleTitle=?, middleSubtitle=?, contactAddress=?, contactPhone=?, contactEmail=?, socialFacebook=?, socialTwitter=?, socialInstagram=?, socialLinkedin=?, lastModified=? WHERE officeID=?");
                $query->execute(array($_POST['headTitle'],$_POST['headSubtitle'],$_SESSION['UploadImgName'],$_POST['middleTitle'],$_POST['middleSubtitle'],$_POST['contactAddress'],$_POST['contactPhone'],$_POST['contactEmail'],$_POST['socialFacebook'],$_POST['socialTwitter'],$_POST['socialInstagram'],$_POST['socialLinkedin'],time(),$_GET['id']));
                if($query){
                    unset($_SESSION['UploadImgName']);
                    echo "<script> alert('Template updated successfully'); </script>";
                } else {
                    echo "<script> alert('Error updating template'); </script>";
                }
            }
        } else {
            $query = $conn->prepare("UPDATE shop1 SET headTitle=?, headSubtitle=?, middleTitle=?, middleSubtitle=?, contactAddress=?, contactPhone=?, contactEmail=?, socialFacebook=?, socialTwitter=?, socialInstagram=?, socialLinkedin=?, lastModified=? WHERE officeID=?");
            $query->execute(array($_POST['headTitle'],$_POST['headSubtitle'],$_POST['middleTitle'],$_POST['middleSubtitle'],$_POST['contactAddress'],$_POST['contactPhone'],$_POST['contactEmail'],$_POST['socialFacebook'],$_POST['socialTwitter'],$_POST['socialInstagram'],$_POST['socialLinkedin'],time(),$_GET['id']));
            if($query){
                echo "<script> alert('Template updated successfully'); </script>";
            } else {
                echo "<script> alert('Error updating template'); </script>";
            }
        }
    }
?>