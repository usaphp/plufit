<?php
header("Content-type: image/png");

$watermark = imagecreatefrompng('watermarks/black-plufit.png');
$image = imagecreatefromjpeg('../../uploads/'.$_GET['path']);

imagealphablending($watermark, false);
imagesavealpha($watermark, true);

imagecopymerge($watermark, $image, 10, 9, 0, 0, 181, 180, 100); //have to play with these numbers for it to work for you, etc.

header('Content-Type: image/png');
imagepng($watermark);

imagedestroy($watermark);
imagedestroy($image);

/*
    // this script creates a watermarked image from an image file - can be a .jpg .gif or .png file
    // where watermark.gif is a mostly transparent gif image with the watermark - goes in the same directory as this script
    // where this script is named watermark.php
    // call this script with an image tag
    // <img src="watermark.php?path=imagepath"> where path is a relative path such as subdirectory/image.jpg
	echo ''; //this echo just force the header do be over
	@include(dirname(__FILE__).'/../../../wp-load.php' );
	if (get_option('upload_path') == false) {
		$dynpicwatermark_wp_option_upload_path = 'wp-content/uploads';
	} else {
		$dynpicwatermark_wp_option_upload_path = get_option('upload_path');
	}
    $dynpicwatermark_imagesource = dirname(__FILE__).'/../../../' . $dynpicwatermark_wp_option_upload_path . '/' . $_GET['path'];
	
	$dynpicwatermark_posV=substr(get_option('dynpicwatermark_default_position'),0,1);
	$dynpicwatermark_posH=substr(get_option('dynpicwatermark_default_position'),1,1);
	
	if (get_option('dynpicwatermark_force_default_position') == 'false') {
		$dynpicwatermark_posV= preg_replace("/([^TMB])/i", $dynpicwatermark_posV, substr($_GET['position'],0,1));
		$dynpicwatermark_posH= preg_replace("/([^[LCR])/i", $dynpicwatermark_posH, substr($_GET['position'],1,1));
	}

	
	$dynpicwatermark_watermarkdesiredtype=get_option('dynpicwatermark_size_type');
	$dynpicwatermark_watermarkdesiredValue=get_option('dynpicwatermark_size_value')+0;
    $dynpicwatermark_watermarkPath = dirname(__FILE__).'/watermarks/'.get_option('dynpicwatermark_watermark_file');
    $dynpicwatermark_filetype = substr($dynpicwatermark_imagesource,strlen($dynpicwatermark_imagesource)-4,4);
    $dynpicwatermark_filetype = strtolower($dynpicwatermark_filetype);
    $dynpicwatermark_watermarkType = substr($dynpicwatermark_watermarkPath,strlen($dynpicwatermark_watermarkPath)-4,4);
    $dynpicwatermark_watermarkType = strtolower($dynpicwatermark_watermarkType);

	
	
    if($dynpicwatermark_filetype == '.gif')  
        $dynpicwatermark_image = imagecreatefromgif($dynpicwatermark_imagesource);
    else  
        if($dynpicwatermark_filetype == '.jpg' || $dynpicwatermark_filetype == 'jpeg')  
            $dynpicwatermark_image = imagecreatefromjpeg($dynpicwatermark_imagesource);
        else
            if($dynpicwatermark_filetype == '.png')  
                $dynpicwatermark_image = imagecreatefrompng($dynpicwatermark_imagesource);
            else
                die();  

    if(!$dynpicwatermark_image) 
        die('merda');
    
    if($dynpicwatermark_watermarkType == ".gif")
        $dynpicwatermark_watermark = @imagecreatefromgif($dynpicwatermark_watermarkPath);
    else
        if($dynpicwatermark_watermarkType == ".png")
            $dynpicwatermark_watermark = @imagecreatefrompng($dynpicwatermark_watermarkPath);
        else
            die();
    if(!$dynpicwatermark_watermark)
        die();
	
     $dynpicwatermark_imagewidth = imagesx($dynpicwatermark_image);
     $dynpicwatermark_imageheight = imagesy($dynpicwatermark_image);  
     $dynpicwatermark_watermarkwidth =  imagesx($dynpicwatermark_watermark);
     $dynpicwatermark_watermarkheight =  imagesy($dynpicwatermark_watermark);

	 $dynpicwatermark_watermarkdesiredSizeW=$dynpicwatermark_watermarkwidth;
	$dynpicwatermark_watermarkdesiredSizeH=$dynpicwatermark_watermarkheight;
	if ($dynpicwatermark_watermarkdesiredtype=='W%'){
		$dynpicwatermark_watermarkdesiredSizeW = $dynpicwatermark_watermarkdesiredValue * $dynpicwatermark_imagewidth;
		$dynpicwatermark_ratio = $dynpicwatermark_watermarkheight / $dynpicwatermark_watermarkwidth;
		$dynpicwatermark_watermarkdesiredSizeH = $dynpicwatermark_ratio * $dynpicwatermark_watermarkdesiredSizeW;
	}
	if ($dynpicwatermark_watermarkdesiredtype=='W'){
		$dynpicwatermark_watermarkdesiredSizeW = $dynpicwatermark_watermarkdesiredValue;
		$dynpicwatermark_ratio = $dynpicwatermark_watermarkdesiredSizeW / $dynpicwatermark_watermarkwidth;
		$dynpicwatermark_watermarkdesiredSizeH = $dynpicwatermark_ratio * $dynpicwatermark_watermarkheight;
	}
	if ($dynpicwatermark_watermarkdesiredtype=='H%'){
		$dynpicwatermark_watermarkdesiredSizeH = $dynpicwatermark_watermarkdesiredValue * $dynpicwatermark_imageheight;
		$dynpicwatermark_ratio = $dynpicwatermark_watermarkwidth / $dynpicwatermark_watermarkheight;
		$dynpicwatermark_watermarkdesiredSizeW = $dynpicwatermark_ratio * $dynpicwatermark_watermarkdesiredSizeH;
	}
	if ($dynpicwatermark_watermarkdesiredtype=='H'){
		$dynpicwatermark_watermarkdesiredSizeH = $dynpicwatermark_watermarkdesiredValue;
		$dynpicwatermark_ratio = $dynpicwatermark_watermarkdesiredSizeH / $dynpicwatermark_watermarkheight;
		$dynpicwatermark_watermarkdesiredSizeW = $dynpicwatermark_ratio * $dynpicwatermark_watermarkwidth;
	}
	 
	 if ($dynpicwatermark_posV=='T') {
		$dynpicwatermark_startheight = 0;
	 } elseif ($dynpicwatermark_posV=='B') {
		$dynpicwatermark_startheight = ($dynpicwatermark_imageheight - $dynpicwatermark_watermarkdesiredSizeH-1);
	 } else {
		$dynpicwatermark_startheight = (($dynpicwatermark_imageheight - $dynpicwatermark_watermarkdesiredSizeH)/2);
	 }
	 if ($dynpicwatermark_posH=='L') {
		$dynpicwatermark_startwidth = 0;
	 } elseif ($dynpicwatermark_posH=='R') {
		$dynpicwatermark_startwidth = ($dynpicwatermark_imagewidth - $dynpicwatermark_watermarkdesiredSizeW-1);
	 } else {
		$dynpicwatermark_startwidth = (($dynpicwatermark_imagewidth - $dynpicwatermark_watermarkdesiredSizeW)/2);
	 }
     imagecopyresized  ($dynpicwatermark_image, $dynpicwatermark_watermark,  $dynpicwatermark_startwidth, $dynpicwatermark_startheight, 0, 0, $dynpicwatermark_watermarkdesiredSizeW, $dynpicwatermark_watermarkdesiredSizeH, $dynpicwatermark_watermarkwidth , $dynpicwatermark_watermarkheight );
     imagejpeg($dynpicwatermark_image);
     imagedestroy($dynpicwatermark_image);
     imagedestroy($dynpicwatermark_watermark); */
 ?>