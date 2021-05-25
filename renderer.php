<?php
/* Render, please PHP by DevJjck, 2021
Original Render, please by Lunnaholy */
class Renderer {
  public function __construct($x = 0, $y = 0) {
    $this->startX = $x;
    $this->startY = $y;
  }

  protected function hexColorAllocate($im,$hex){
    $hex = ltrim($hex,'#');
    $r = hexdec(substr($hex,0,2));
    $g = hexdec(substr($hex,2,2));
    $b = hexdec(substr($hex,4,2));
    return imagecolorallocate($im, $r, $g, $b); 
  }

  public function render($ava, $type = 'jpeg') {
    if(empty($ava)) throw new Exception('avatar cannot be empty');

    $ava = str_replace("<UserAvatar><pixels>", "", $ava);
    $ava = str_replace("</pixels></UserAvatar>", "", $ava);

    $canvas = $this->processRender($ava);
    ob_start(); 
    imagejpeg ($canvas);
    $image_data = ob_get_contents(); 
    ob_end_clean(); 
    imagedestroy($canvas);

    if($type == 'jpeg') {
      header('Content-Type: image/jpeg');
      $image = $image_data;
    } else if($type == 'base64') {
      $image = base64_encode($image_data);
    } else {
      throw new Exception('unknown image type');
    }
    return $image;
  }

  protected function processRender($ava) {
    $canvas = imagecreatetruecolor(189,219);
    $x = $this->startX;
    $y = $this->startY;

    for($index = 4; $index < strlen($ava); $index += 6){
      $hexcolor = substr($ava, $index + 4, 2) . substr($ava, $index + 2, 2) . substr($ava, $index, 2);
      $color = $this->hexColorAllocate($canvas, $hexcolor);
      //imagefilledrectangle($canvas, $x, $y, 1, 1, $color);
      imagesetpixel($canvas, $x, $y, $color);
      //ctx.fillRect(x, y, 1, 1);
      $x++;
      if($x == 189){ // go to new line
        $x = 0;
        $y++;
        $index = $index + 2;
      }
    }
    return $canvas;
  }
}
