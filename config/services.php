<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '654315044733493',
        'client_secret' => '720967bfa1755b4a95c8182eaf0c18ef',
        'redirect' => 'http://bosco.pe/iniciar-sesion/fb/callback',
    ],

    'sendgrid' => [
        'api_key' => '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',
    ],
];
