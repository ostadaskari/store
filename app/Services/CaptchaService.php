<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CaptchaService
{
    public static function generate(string $key = 'default'): string
    {
        // استفاده از اعداد و حروف خوانا (حذف حروف شبیه به هم مثل O, 0, I, l)
        $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 5; $i++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        // ذخیره کد در سشن با کلید اختصاصی (برای پشتیبانی همزمان چند فرم)
        Session::put("custom_captcha_{$key}", strtolower($code));

        return self::renderSvg($code);
    }

    public static function verify(?string $input, string $key = 'default'): bool
    {
        if (empty($input)) {
            return false;
        }

        $sessionKey = "custom_captcha_{$key}";
        $stored = Session::get($sessionKey);

        // پاک کردن کد بلافاصله پس از یک بار بررسی (جلوگیری از Replay Attack)
        Session::forget($sessionKey);

        return $stored && strtolower(trim($input)) === $stored;
    }

    private static function renderSvg(string $code): string
    {
        $width = 150;
        $height = 46;
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $width . '" height="' . $height . '" viewBox="0 0 ' . $width . ' ' . $height . '" style="border-radius: 8px; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); border: 1px solid #dee2e6; user-select: none;">';

        // ۱. اضافه کردن خطوط نویز پس‌زمینه برای گمراه کردن ربات‌ها
        for ($i = 0; $i < 6; $i++) {
            $x1 = random_int(0, $width);
            $y1 = random_int(0, $height);
            $x2 = random_int(0, $width);
            $y2 = random_int(0, $height);
            $colors = ['#adb5bd', '#ced4da', '#9ec5fe', '#f1aeb5', '#a3cfbb'];
            $color = $colors[array_rand($colors)];
            $svg .= '<line x1="' . $x1 . '" y1="' . $y1 . '" x2="' . $x2 . '" y2="' . $y2 . '" stroke="' . $color . '" stroke-width="1.5" opacity="0.7" />';
        }

        // ۲. اضافه کردن نقاط نویز
        for ($i = 0; $i < 25; $i++) {
            $cx = random_int(5, $width - 5);
            $cy = random_int(5, $height - 5);
            $svg .= '<circle cx="' . $cx . '" cy="' . $cy . '" r="1.2" fill="#6c757d" opacity="0.4" />';
        }

        // ۳. رندر کردن حروف با چرخش و رنگ متفاوت
        $textColors = ['#0d6efd', '#198754', '#dc3545', '#6610f2', '#212529', '#0dcaf0'];
        $chars = str_split($code);
        foreach ($chars as $index => $char) {
            $x = 20 + ($index * 24) + random_int(-3, 3);
            $y = 31 + random_int(-4, 4);
            $rotate = random_int(-18, 18);
            $color = $textColors[array_rand($textColors)];

            $svg .= '<text x="' . $x . '" y="' . $y . '" fill="' . $color . '" font-family="monospace, sans-serif" font-size="22" font-weight="bold" transform="rotate(' . $rotate . ' ' . $x . ',' . $y . ')">' . $char . '</text>';
        }

        $svg .= '</svg>';
        return $svg;
    }
}
