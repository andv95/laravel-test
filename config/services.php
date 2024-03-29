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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '1075476146416368',
        'client_secret' => '61fa0b80455e0007b2a4d9d43c6c3246',
        'redirect' => 'https://local.laravel.co/login/facebook/callback',
    ],

    'google' => [
        'client_id' => '764181515225-9gcq4mhikn3u0fhacl3irfa16qsiqlj0.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://local.laravel.co/login/google/callback',
    ],
];
