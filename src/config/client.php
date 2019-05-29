<?php
//example clients configuration
return [
    'billing' => [
        'url' => 'http://billing.rem-dev.com/',
        'endpoints' => [
            'api' => '',
        ],
        'secret' => 'VFZ3H7JcbGeHVRPvjsVHbGHg2rzC93yWRs3tRyZsF5zDC3f8mFgmR2kcuqH3KEem',
        'name' => 'deal',
        'ip' => '91.150.169.99',
        'timeout' => 10,
        'debug' => \Rem\RemClient\RemClient::DEBUG_THROW_EXCEPTION,
        // 'ssl' => 'path_to_file_or_directory',
    ],
];
