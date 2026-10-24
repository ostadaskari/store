<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
// اجرای دستور تولید سایت‌مپ به صورت روزانه در ساعت 00:00 بامداد
Schedule::command('sitemap:generate')->daily();
