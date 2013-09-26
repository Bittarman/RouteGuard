<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuard\Guard\Http;

use Zend\Mvc\Request;
use Zend\Stdlib\RequestInterface;
use RouteGuard\Guard\GuardInterface;
use RouteGuard\Guard\InvalidAssertionException;

class Regexp implements GuardInterface
{
    /**
     * @var string
     */
    protected $regexp;

    /**
     * @var Callable
     */
    protected $assertion;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
	if (isset($options['regexp'])) {
            $this->setRegexp($options['regexp']);
        }
        if (isset($options['assertion'])) {
            $this->setAssertion($options['assertion']);
        }
    }

    /**
     * Check if the guard applies to the request,
     * then apply the assigned assertion.
     *
     * @param  \Zend\Stdlib\RequestInterface $uri
     * @return bool
     */
    public function isAllowed(RequestInterface $uri)
    {
        if (preg_match(sprintf('#^%s$#', $this->regexp), $uri->getUri()->getPath())) {
            if (isset($this->assertion)) {
                $assertion = $this->assertion;

                return $assertion();
            } else {
                return true;
            }
        }

        return true;
    }

    /**
     * @param string $regexp
     */
    public function setRegexp($regexp)
    {
        $this->regexp = $regexp;
    }

    /**
     * @param callable $assertion
     */
    public function setAssertion($assertion)
    {
        if (!is_callable($assertion)) {
            throw new InvalidAssertionException('The assertion supplied is not a callable object or closure');
        }
        $this->assertion = $assertion;
    }
}
