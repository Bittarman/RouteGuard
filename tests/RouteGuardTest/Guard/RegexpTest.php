<?php
/**
 * RouteGuard for Zend Framework 2
 *
 * @link https://github.com/Bittarman/RouteGuard for the canonical source repository
 * @copyright Copyright (c) Ryan Mauger 2013 (http://rmauger.co.uk)
 * @license https://github.com/Bittarman/RouteGuard/blob/master/LICENSE
 */

namespace RouteGuardTest\Guard;

use RouteGuard\Guard\Http\Regexp;
use Zend\Http\Request as HttpRequest;

class RegexpTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testBasicRegexWithNoAssertion()
    {
        $regexpGuard = new Regexp(array(
            'regexp' => '(/account(?!/login)/?.*)'
        ));
        $request = new HttpRequest();
        // With no assertion guard will always return true
        $request->setUri('/account/login');
        $this->assertTrue($regexpGuard->isAllowed($request));
        $request->setUri('/account');
        $this->assertTrue($regexpGuard->isAllowed($request));
        $request->setUri('/account/');
        $this->assertTrue($regexpGuard->isAllowed($request));
        $request->setUri('/account/foo/bar');
        $this->assertTrue($regexpGuard->isAllowed($request));
    }

    public function testBasicRegexWithBasicAssertion()
    {

        $regexpGuard = new Regexp(array(
            'regexp' => '(/account(?!/login)/?.*)',
        ));
        $request = new HttpRequest();
        $trueAssertion = function(){ return true;};
        $falseAssertion = function(){ return false;};

        // With no assertion guard will always return true
        $request->setUri('/account/login');
        $this->assertTrue($regexpGuard->isAllowed($request));

        // With the false assertion, everything should fail
        $regexpGuard->setAssertion($falseAssertion);
        $request->setUri('/account');
        $this->assertFalse($regexpGuard->isAllowed($request));
        $request->setUri('/account/');
        $this->assertFalse($regexpGuard->isAllowed($request));
        $request->setUri('/account/foo/bar');
        $this->assertFalse($regexpGuard->isAllowed($request));

        // With the true assertion, everything should pass
        $regexpGuard->setAssertion($trueAssertion);
        $request->setUri('/account');
        $this->assertTrue($regexpGuard->isAllowed($request));
        $request->setUri('/account/');
        $this->assertTrue($regexpGuard->isAllowed($request));
        $request->setUri('/account/foo/bar');
        $this->assertTrue($regexpGuard->isAllowed($request));
    }

    public function testInvalidAssertion()
    {
        $this->setExpectedException(
            'RouteGuard\Guard\InvalidAssertionException',
            'The assertion supplied is not a callable object or closure'
        );
        new Regexp(array(
            'regexp' => '(/account(?!/login)/?.*)',
            'assertion' => 'test'
        ));

    }

}
