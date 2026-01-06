<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
    {
        // 1. Generate random numbers for a simple math equation
        $num1 = rand(1, 9);
        $num2 = rand(1, 9);
        $result = $num1 + $num2;

        // 2. Store result in session (encrypted by Laravel session driver)
        Session::put('captcha_answer', $result);
        Session::save();

        // 3. Create the image using GD library
        $width = 120;
        $height = 40;
        $image = imagecreate($width, $height);

        // Colors
        $background = imagecolorallocate($image, 240, 240, 240); // Light gray
        $textColor = imagecolorallocate($image, 0, 49, 83);      // Your brand blue
        $noiseColor = imagecolorallocate($image, 100, 120, 140);

        // Add some noise (dots/lines) to prevent OCR bots
        for ($i = 0; $i < 50; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
        }
        imageline($image, 0, rand(0, $height), $width, rand(0, $height), $noiseColor);

        // 4. Write the text (num1 + num2)
        $text = "$num1 + $num2 = ?";
        // Use a built-in font (1-5) or you could use imagettftext for custom fonts
        imagestring($image, 5, 20, 12, $text, $textColor);

        // 5. Output image
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
        exit;
    }
}
