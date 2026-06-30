<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class SimpleCaptchaService
{
    public const SESSION_KEY = 'guest_captcha_code';

    public function generateCode(int $length = 5): string
    {
        $characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[random_int(0, strlen($characters) - 1)];
        }

        Session::put(self::SESSION_KEY, $code);

        return $code;
    }

    public function getOrCreateCode(): string
    {
        $code = Session::get(self::SESSION_KEY);

        if (!is_string($code) || $code === '') {
            return $this->generateCode();
        }

        return $code;
    }

    public function verify(?string $input): bool
    {
        $expected = Session::get(self::SESSION_KEY);

        if (!is_string($expected) || $expected === '' || !is_string($input) || trim($input) === '') {
            return false;
        }

        $valid = strtoupper(trim($input)) === strtoupper($expected);

        Session::forget(self::SESSION_KEY);

        return $valid;
    }

    public function imageResponse(string $code)
    {
        if (!function_exists('imagecreatetruecolor')) {
            abort(500, 'Captcha image support is not available.');
        }

        $width = 150;
        $height = 50;
        $image = imagecreatetruecolor($width, $height);

        $background = imagecolorallocate($image, 242, 244, 245);
        $textColor = imagecolorallocate($image, 25, 35, 45);
        $lineColor = imagecolorallocate($image, 180, 190, 200);

        imagefilledrectangle($image, 0, 0, $width, $height, $background);

        for ($i = 0; $i < 5; $i++) {
            imageline(
                $image,
                random_int(0, $width),
                random_int(0, $height),
                random_int(0, $width),
                random_int(0, $height),
                $lineColor
            );
        }

        $fontSize = 5;
        $charWidth = imagefontwidth($fontSize);
        $charHeight = imagefontheight($fontSize);
        $textWidth = strlen($code) * ($charWidth + 4);
        $x = (int) (($width - $textWidth) / 2);
        $y = (int) (($height - $charHeight) / 2);

        foreach (str_split($code) as $index => $char) {
            $offsetY = random_int(-2, 2);
            imagestring(
                $image,
                $fontSize,
                $x + ($index * ($charWidth + 4)),
                $y + $offsetY,
                $char,
                $textColor
            );
        }

        ob_start();
        imagepng($image);
        $contents = ob_get_clean();
        imagedestroy($image);

        return response($contents, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
        ]);
    }
}
