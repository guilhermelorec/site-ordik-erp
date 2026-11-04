<?php

return [
    'contact_email' => env('ORDIK_CONTACT_EMAIL', 'comercial@ordik.com.br'),

    'leads_notify_email' => env('LEADS_NOTIFY_EMAIL'),

    'admin' => [
        'name' => env('ADMIN_NAME', 'Admin Ordik'),
        'email' => env('ADMIN_EMAIL'),
        'password' => env('ADMIN_PASSWORD'),
    ],
];
