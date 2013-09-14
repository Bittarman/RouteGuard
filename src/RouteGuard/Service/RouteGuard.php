<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard;

use RouteGuard\Guard\InstanceLoader;
use RouteGuard\UnauthorizedAccessException;
use Zend\Mvc\MvcEvent;

class RouteGuard
{
    /**
     * @var array
     */
    protected $guards = array();

    /**
     * @var InstanceLoader
     */
    protected $instanceLoader;

    public function __construct(array $guards, InstanceLoader $instanceLoader)
    {
        $this->instanceLoader = $instanceLoader;
        foreach ($guards as $guard) {
            if (is_array($guard)) {
                $guard = $instanceLoader->factory($guard['type'], $guard['options']);
            }
            $this->addGuard($guard);
        }
    }

    public function addGuard(GuardInterface $guard)
    {
        $this->guards[] = $guard;
    }

    /**
     * @param MvcEvent $event
     */
    public function onRoute(MvcEvent $event)
    {
        /** @var \Zend\Http\Request $request */
        $request = $event->getRequest();
        if (!$this->isAllowed($request)) {
            $event->setError('error-unauthorized-route');
            /* @var $app \Zend\Mvc\Application */
            $app = $event->getTarget();
            $event->setParam('exception', new UnauthorizedAccessException('You are not currently allowed access to this page'));
            $app->getEventManager()->trigger(MvcEvent::EVENT_DISPATCH_ERROR, $event);
            return false;
        }
    }

    public function isAllowed($uri)
    {
        foreach($this->guards as $guard) {
            if (!$guard->isAllowed($uri)) {
                return false;
            }
        }
        return true;
    }
} 