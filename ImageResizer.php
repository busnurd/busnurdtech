<?php
function imageResizer($imageSource, $saveTo, $width, $height, $imageName) {
	// get image details
	list($w,$h,$type) = getimagesize($imageSource);
	
	// calculate the scaling ratio
	if ($w <= $width && $h <= $height) {
		$ratio = 1;
	} else if ($w > $h) {
		$ratio = $width / $w;
	} else {
		$ratio = $height / $h;
	}
	
	$original = $imageSource;
	
	// create an image resource for the original image
	switch ($type) {
		case 1: $source = imagecreatefromgif($original); break;
		case 2: $source = imagecreatefromjpeg($original); break;
		case 3: $source = imagecreatefrompng($original); break;
		default: $source = null; echo 'Cannot Identify filetype';
	}
	
	// calculate the dimension of the resized image based on ratio
	$newWidth = $w * $ratio;
	$newHeight = $h * $ratio;
	
	// create an image resource for the new image
	$newImage = imagecreatetruecolor($newWidth, $newHeight);
	
	// write the source image to the new image resource
	imagecopyresampled($newImage,$source,0,0,0,0,$newWidth,$newHeight,$w,$h);
	
	// create actual image from the new image resource and write to file
	switch ($type) {
		case 1: imagegif($newImage, $saveTo.$imageName.'.gif'); $imgName = $imageName.'.gif'; break;
		case 2: imagejpeg($newImage, $saveTo.$imageName.'.jpg', 100); $imgName = $imageName.'.jpg'; break;
		case 3: imagepng($newImage, $saveTo.$imageName.'.png'); $imgName = $imageName.'.png'; break;
	}
	
	// remove image resources from memory
	imagedestroy($newImage);
	
	if ($imgName) {
		return $imgName;
	} else {
		return false;
	}
}	
?>