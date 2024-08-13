<?php
/* Render, please PHP by DevJjck, 2024
 Original Render, please by Lunnaholy */
class Renderer
{
    public function __construct($x = 0, $y = 0)
    {
        $this->startX = $x;
        $this->startY = $y;
    }

    protected function hexColorAllocate($im, $hex)
    {
        $hex = ltrim($hex, '#');
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return imagecolorallocate($im, $r, $g, $b);
    }

    public function render($ava, $type = 'jpeg', $file = null)
    {
        if (empty($ava))
            throw new Exception('Avatar cannot be empty');
        
        if ($type == 'base64' && !empty($saveTo))
            throw new Exception('Cannot save base64 image to file');

        $ava = str_replace("<UserAvatar><pixels>", "", $ava);
        $ava = str_replace("</pixels></UserAvatar>", "", $ava);

        $canvas = $this->processRender($ava);

        if (empty($file))
            ob_start();

        switch ($type) {
            case 'jpeg':
            case 'jpg':
                $result = imagejpeg($canvas, $file, 100);
                break;
            case 'png':
                $result = imagepng($canvas, $file, 0);
                break;
            case 'base64':
                $result = imagepng($canvas, $file, 0);
                break;
            default:
                throw new Exception('unknown image type');
        }

        if (empty($file)) {
            $image = ob_get_contents();
            ob_end_clean();
            imagedestroy($canvas);
            return $type !== 'base64' ? $image : base64_encode($image);
        } else {
            return $result;
        }
    }

    protected function processRender($ava)
    {
        $canvas = imagecreatetruecolor(189, 219);
        
        $x = $this->startX;
        $y = $this->startY;

        for ($index = 4; $index < strlen($ava); $index += 6) {
            $hexcolor = substr($ava, $index + 4, 2) . substr($ava, $index + 2, 2) . substr($ava, $index, 2);
            $color = $this->hexColorAllocate($canvas, $hexcolor);
            imagesetpixel($canvas, $x, $y, $color);
            $x++;
            if ($x == 189) {
                // go to new line
                $x = 0;
                $y++;
                $index = $index + 2;
            }
        }
        return $canvas;
    }
}
?>
