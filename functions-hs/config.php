<?php

$baseUrl = '/';
return array(
    'base_url' => $baseUrl,
    'urls' => [
        'user' => $baseUrl . 'hs-user/',
        'admin' => $baseUrl . 'hs-admin/',
        'user-api' => $baseUrl . 'hs-user/api/',
        'user-uploads' => $baseUrl . 'hs-user/uploads/',
    ],
    'paths' => [
        'user-uploads' => __DIR__.'/../uploads/',
        'user-profile' => __DIR__.'/../../scripts/dist/img/admin/',
        'user-link' => __DIR__.'/../../scripts/dist/img/admin/link/',
    ],
    'database' => array(
        'host' => HOST,
        'user' => USER,
        'password' => PASSWORD,
        'database' => DATABASE,
    ),
);