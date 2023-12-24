<?php
define("MB", 1048576);

function imageUpload( $dir, $imageRequest)
{
    global $msgError;
    if(isset($_FILES[$imageRequest])){
        $imagename  = rand(1000, 10000) . $_FILES[$imageRequest]['name'];
        $imagetmp   = $_FILES[$imageRequest]['tmp_name'];
        $imagesize  = $_FILES[$imageRequest]['size'];
        $allowExt   = array("jpg", "png", "gif", "mp3", "pdf");
        $strToArray = explode(".", $imagename);
        $ext        = end($strToArray);
        $ext        = strtolower($ext);

    if (!empty($imagename) && !in_array($ext, $allowExt)) {
        $msgError = "EXT";
    }
    if ($imagesize > 5 * MB) {
        $msgError = "size";
    }
    if (empty($msgError)) {
        move_uploaded_file($imagetmp, $dir . "/" . $imagename);
        return $imagename;
    } else {
        return "fail";
    }

    }else {
        return 'empty';
    }
    
}

?>