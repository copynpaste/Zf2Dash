<?php
/**
 * User: garyhockin
 * Date: 25/01/2014
 * Time: 15:53
 */

namespace DashZf2Test\Router;

use DashZf2\Router\RouterBridge;

class RouterBridgeTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $dashRouterMock = $this->getMock('Dash\Router\Http\Router', array(), array(), '', false);
        $routerBridge = new RouterBridge($dashRouterMock);
        $this->assertEquals($dashRouterMock, $routerBridge->getDashRouter());
    }

    public function testMatch()
    {
        $dashRouteMatchMock = $this->getMock('Dash\Router\Http\RouteMatch', array(), array(), '', false);
        $dashRouteMatchMock->expects($this->once())->method('getParams')->will($this->returnValue(array()));
        $dashRouteMatchMock->expects($this->once())->method('getRouteName')->will($this->returnValue('zoidberg'));

        $dashRouterMock = $this->getMock('Dash\Router\Http\Router', array(), array(), '', false);
        $dashRouterMock->expects($this->once())->method('match')->will($this->returnValue($dashRouteMatchMock));

        $httpRequestMock = $this->getMock('Zend\Http\PhpEnvironment\Request');

        $routerBridge = new RouterBridge($dashRouterMock);

        $this->assertInstanceOf('Zend\Mvc\Router\Http\RouteMatch', $routerBridge->match($httpRequestMock));
    }

    public function testDoesntMatch()
    {
        $dashRouterMock = $this->getMock('Dash\Router\Http\Router', array(), array(), '', false);
        $dashRouterMock->expects($this->once())->method('match')->will($this->returnValue(null));

        $httpRequestMock = $this->getMock('Zend\Http\PhpEnvironment\Request');

        $routerBridge = new RouterBridge($dashRouterMock);

        $this->assertNull($routerBridge->match($httpRequestMock));
    }

}
 