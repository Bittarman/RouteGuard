<?php


namespace RouteGuard\Assertion\Zf2Authentication\Factory;

use RouteGuard\Assertion\Zf2Authentication\IsLoggedIn;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class IsLoggedInFactory
 *
 * @package RouteGuard\Assertion\Zf2Authentication\Factory
 */
class IsLoggedInFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /**
         * @var \Zend\Authentication\AuthenticationService $service
         */
        $service   = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        $assertion = new IsLoggedIn($service);

        return $assertion;
    }

} 