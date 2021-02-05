<?php
if(isset($_POST['addProd'])){
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
     	$image =$_FILES["file"]["name"];
    	$uploadedfile = $_FILES['file']['tmp_name'];


     	if ($image)
     	{

     		$filename = stripslashes($_FILES['file']['name']);

      		$extension = getExtension($filename);
     		$extension = strtolower($extension);


     if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
     		{

     			$change='<div class="msgdiv">Unknown Image extension </div> ';
     			$errors=1;
     		}
     		else
     		{

     $size=filesize($_FILES['file']['tmp_name']);


    if ($size > MAX_SIZE*1024)
    {
    	$change='<div class="msgdiv">You have exceeded the size limit!</div> ';
    	$errors=1;
    }


    if($extension=="jpg" || $extension=="jpeg" )
    {
    $uploadedfile = $_FILES['file']['tmp_name'];
    $src = imagecreatefromjpeg($uploadedfile);

    }
    else if($extension=="png")
    {
    $uploadedfile = $_FILES['file']['tmp_name'];
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

    $randImage = rand(1111111,9999999);
    $filename = "../assets/images/products/". $randImage.".".$extension;
    $newfilename = "assets/images/products/". $randImage.".".$extension;



    imagejpeg($tmp,$filename,100);

    imagedestroy($src);
    imagedestroy($tmp);
    imagedestroy($tmp1);
    }}

    }

    //If no errors registred, print the success message
     if(!$errors)
     {
       $addCat = $conn->prepare("INSERT INTO services(officeID, serviceName,serviceDesc, serviceImage) VALUES (?,?,?,?)");
       $addCat->execute(array($_GET['id'],$_POST['serviceName'], $_POST['serviceDesc'],$newfilename));
       if($addCat){
         echo "<script> alert('Service added successfully'); window.location = 'services.php?id=".$_GET['id']."'; </script>";
       } else {
		echo "<script> alert('an error occured'); </script>";
	}
     } else {
	echo "<script> alert('an error occured'); </script>";
	}

}

?>
