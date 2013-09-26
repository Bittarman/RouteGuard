<?php
return [
    'guards' => [], // Make sure an entry exists by default, but add no guards.
    'service_manager' => [
        'factories' => [
            'RouteGuard\Service\RouteGuard' => 'RouteGuard\Service\Factory\RouteGuardFactory',
            'RouteGuard\Service\GuardLoader' => 'RouteGuard\Service\Factory\GuardLoaderFactory'
        ]
    ],
    'guard' => [
        'instance_loader' => [
            'factories' => [
                'Regexp' => 'RouteGuard\Guard\Http\Factory\RegexpGuardFactory'
            ]
        ],
    ]
];