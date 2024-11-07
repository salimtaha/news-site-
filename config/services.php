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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    // 'whatsapp' => [
    //     'from-phone-number-id' => env('WHATSAPP_FROM_PHONE_NUMBER_ID'),
    //     'token' => env('WHATSAPP_TOKEN'),
    // ],

    'google' => [
        'client_id' => '67792653438-dricnjoaf57tn54aeqhmbc72n5h7vnsq.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '576603571440996',
        'client_secret' => '33a4500577509a7731b3e9ee6fca9a67',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],








];
