<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsIrService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.sms.key');
        $this->apiUrl = 'https://api.sms.ir/v1/send/verify';
    }

    public function sendVerificationCode(string $mobile, string $code)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->post($this->apiUrl, [
            'mobile' => $mobile,
            'templateId' => config('services.sms.template'), // If using pattern
            'parameters' => [
                ['name' => 'Code', 'value' => $code]
            ]
        ]);

        return $response->body();
    }
}

