<?php


    session_start();
function compareColor($colorArray1,$colorArray2,$delta=20){
  
//    
    if (abs($colorArray1["red"]-$colorArray2["red"])<=$delta
        && abs($colorArray1["green"]-$colorArray2["green"])<=$delta
        && abs($colorArray1["blue"]-$colorArray2["blue"])<=$delta        
            ){
        return 0;
    } 
    if ($colorArray1["red"]<$colorArray2["red"]
       && $colorArray1["green"]<$colorArray2["green"]
       && $colorArray1["blue"]<$colorArray2["blue"]){
      return -1;
    }
    if ($colorArray1["red"]>$colorArray2["red"]
       && $colorArray1["green"]>$colorArray2["green"]
       && $colorArray1["blue"]>$colorArray2["blue"]){
      return 1;
    }
         
    
}     
  if (isset($_GET['idx'])){
         $curIdx=$_GET['idx'];
         $prevIdx=$curIdx;         
         if ($curIdx > 0 && $curIdx <= count($_SESSION['galleryarray'])-1){
             $prevIdx=$curIdx-1;
         }elseif ($curIdx== 0){
             $prevIdx = count($_SESSION['galleryarray'])-1;
         }
         
// create images
         
         //error_log(print_r($_SESSION['galleryarray'], true));
         //error_log("compare $curIdx : ".$_SESSION['galleryarray'][$curIdx]." with $prevIdx : ".$_SESSION['galleryarray'][$prevIdx]);
         
$i1 = imagecreatefromstring(file_get_contents($_SESSION['galleryarray'][$prevIdx]));
$i2 = imagecreatefromstring(file_get_contents($_SESSION['galleryarray'][$curIdx]));
 
 
// dimensions of the first image
$sx1 = imagesx($i1);
$sy1 = imagesy($i1);
 
$sx2 = imagesx($i2);
$sy2 = imagesy($i2);

if ($sx1==$sx2 && $sy1==$sy2){
// create a diff image
$im = imagecreatetruecolor($sx1, $sy1);
$green = imagecolorallocate($im, 0, 153, 0);
$red = imagecolorallocate($im, 153, 0, 0);
imagefill($im, 0, 0, imagecolorallocate($im, 10, 10, 10));
 
// increment this counter when encountering a pixel diff
$different_pixels = 0;
// loop x and y
for ($x = 0; $x < $sx1; $x++) {
    for ($y = 0; $y < $sy1; $y++) {
 
        $rgb1 = imagecolorat($i1, $x, $y);
        $pix1 = imagecolorsforindex($i1, $rgb1);
 
        $rgb2 = imagecolorat($i2, $x, $y);
        $pix2 = imagecolorsforindex($i2, $rgb2);
 
        $colorDif=$green;
        $comparator= compareColor($pix1,$pix2);
        switch ($comparator) {
          case 0:            

            break;

          case -1:
            $colorDif=$green;
            break;
          case 1:
            $colorDif=$red;
            break;
          
          default:
            break;
        }if ($comparator!=0){
//        if (!isSameColor($pix1,$pix2)){         
  #      if ($pix1 !== $pix2) { // different pixel
            // increment and paint in the diff image
            $different_pixels++;
            imagesetpixel($im, $x, $y, $colorDif);
        }
 
    }
}
header('Content-Type: image/png');


//$im = imagecreatetruecolor(200,200);
//imagefill($im, 0, 0, imagecolorallocate($im, 10, 10, 10));
//$green = imagecolorallocate($im, 132, 135, 28);
//
//// Draw three rectangles each with its own color
//imagerectangle($im, 50, 50, 150, 150, $green);
//
//imagesetpixel($im, 100, 100, $green);
//imagepng($im,'',9); # Warning: imagepng(): Filename cannot be empty
//imagepng($im,NULL,9); # works as expected
//imagedestroy($im);

 header('Content-Type: image/png');
    imagepng($im,NULL,9);
    imagedestroy($im);
}else{
    //error_log('Not the same size ! ('.$sx1."x".$sy1." <> ".$sx2."x".$sy2.")");
}
  }else{
//         error_log("noidx");         
     }
     
?>