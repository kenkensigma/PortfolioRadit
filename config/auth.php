<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Password
    |--------------------------------------------------------------------------
    | Single-password admin auth for the portfolio dashboard.
    | Set ADMIN_PASSWORD in your .env file — never commit the actual value.
    |
    | Example .env entry:
    |   ADMIN_PASSWORD=your-strong-secret-here
    |
    */

    'admin_password' => env('ADMIN_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Laravel Default Auth Config (kept for compatibility)
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard'     => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => env('AUTH_MODEL', App\Models\User::class),
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
