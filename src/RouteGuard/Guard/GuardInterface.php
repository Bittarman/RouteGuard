<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard;


use Zend\Stdlib\RequestInterface;

interface GuardInterface
{
    /**
     * @param $name
     * @return bool
     */
    public function isAllowed(RequestInterface $name);
} 