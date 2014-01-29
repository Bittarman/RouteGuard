<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Assertion\Zf2Authentication;

use Zend\Authentication\AuthenticationService;

class IsLoggedIn
{
    /**
     * @var \Zend\Authentication\AuthenticationService
     */
    protected $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    public function __invoke()
    {
        return $this->service->hasIdentity();
    }
}
