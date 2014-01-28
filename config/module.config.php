<?php
return [
    'guards' => [], // Make sure an entry exists by default, but add no guards.
    'service_manager' => [
        'factories' => [
            'RouteGuard\Service\RouteGuard' => 'RouteGuard\Service\Factory\RouteGuardFactory',
            'RouteGuard\Service\InstanceLoader' => 'RouteGuard\Service\Factory\InstanceLoaderFactory',
            'RouteGuard\Service\GuardLoader' => 'RouteGuard\Service\Factory\GuardLoaderFactory',
            'RouteGuard\Assertion\Zf2Authentication\IsLoggedIn'
                => 'RouteGuard\Assertion\Zf2Authentication\Factory\IsLoggedInFactory',
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