<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsIrService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        // خواندن صحیح کلید API از کانفیگ یا مستقیماً از .env
        $this->apiKey = config('services.sms.key') ?? config('services.smsir.api_key') ?? env('SMSIR_API_KEY');
        $this->apiUrl = 'https://api.sms.ir/v1/send/verify';
    }

    public function sendVerificationCode(string $mobile, string $code)
    {
        $response = Http::withHeaders([
            'X-API-KEY' => $this->apiKey,
        ])->post($this->apiUrl, [
            'mobile' => $mobile,
            'templateId' => config('services.sms.template'),
            'parameters' => [
                ['name' => 'Code', 'value' => $code]
            ]
        ]);

        return $response->body();
    }

    public function sendOrderNotification($mobile, $orderNumber)
    {
        try {
            $templateId = env('SMSIR_TEMPLATE_ORDER_ID', 931824);

            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey, // استفاده از کلید مقداردهی شده در constructor
                'Content-Type' => 'application/json',
            ])->post($this->apiUrl, [
                'mobile' => (string) $mobile,
                'templateId' => (int) $templateId,
                'parameters' => [
                    ['name' => 'ORDER_NUMBER', 'value' => (string) $orderNumber]
                ]
            ]);

            if (!$response->successful()) {
                Log::error('SMS.ir Failed: ' . $response->body());
            }

            return $response->successful();
        } catch (\Exception $e) {
            Log::error('SMS.ir Exception: ' . $e->getMessage());
            return false;
        }
    }
}
