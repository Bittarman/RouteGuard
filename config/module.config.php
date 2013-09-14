<?php
return [
    'guards' => [], // Make sure an entry exists by default, but add no guards.
    'service_manager' => [
        'factories' => [
            'RouteGuard' => 'RouteGuard\Service\Factory\RouteGuardFactory',
            'RouteGuard\Service\InstanceLoader' => 'RouteGuard\Service\Factory\InstanceLoaderFactory'
        ]
    ],
    'guard' => [
        'instance_loader' => [
            'factories' => [
                'Regexp' => 'RouteGuard\Instance\RegexpInstanceFactory'
            ]
        ],
    ]
];