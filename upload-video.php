<?php

if(isset($_FILES['file']['name'])){

   /* Getting file name */
   $filename = $_FILES['file']['name'];

   /* Location */
   $location = "upload/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);
   $location = "upload/".md5(time()).'.'.$imageFileType;
   /* Valid extensions */
   //$valid_extensions = array("jpg","jpeg","png");

   $response = 0;
   if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = $location;
      }

   echo $response;
   exit;
}

echo 0;


