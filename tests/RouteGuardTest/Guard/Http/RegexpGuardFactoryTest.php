<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuardTest\Guard\Http;

use RouteGuard\Assertion\ZF2Authentication\IsLoggedIn;
use RouteGuard\Guard\Http\Factory\RegexpGuardFactory;
use Mockery;

class RegexpGuardFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $factory = new RegexpGuardFactory(
            array(
                'regexp' => '^foo.*',
                'assertion' => 'TestAssertion'
            )
        );
        $serviceManagerMock = Mockery::mock('Zend\ServiceManager\ServiceManager');
        $serviceLocatorMock = Mockery::mock('Zend\ServiceManager\ServiceManager');

        $serviceManagerMock->shouldReceive('getServiceLocator')->times(1)->andReturn($serviceLocatorMock);

        $serviceLocatorMock->shouldReceive('get')->times(1)->andReturn(new IsLoggedIn());
        $serviceLocatorMock->shouldReceive('has')->times(1)->andReturn(true);

        $regexpGuard = $factory->createService($serviceManagerMock);

    }
}