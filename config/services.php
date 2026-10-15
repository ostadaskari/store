<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],
    'smsir' => [
        'api_key' => env('SMSIR_API_KEY'),
        'secret'  => env('SMSIR_SECRET'),
        'base_url'=> env('SMSIR_BASE_URL'), // e.g. https://api.sms.ir
    ],
    'behpardasht' => [
        'terminal_id' => env('BEHPARDASHT_TERMINAL_ID'),
        'username'    => env('BEHPARDASHT_USERNAME'),
        'password'    => env('BEHPARDASHT_PASSWORD'),
        'wsdl'          => env('BEHPARDASHT_WSDL', 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl'),
        'start_pay_url' => env('BEHPARDASHT_START_PAY_URL', 'https://bpm.shaparak.ir/pgwchannel/startpay.mellat'),
    ],



    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
