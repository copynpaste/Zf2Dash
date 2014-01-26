<?php
/**
 * User: garyhockin
 * Date: 25/01/2014
 * Time: 15:52
 */

namespace DashZf2\Router;


use Dash\Router\Http\Router;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\Stdlib\RequestInterface as Request;

class RouterBridge implements RouteStackInterface
{
    /**
     * @var \Dash\Router\Http\Router
     */
    protected $dashRouter;

    function __construct(Router $dashRouter)
    {
        $this->setDashRouter($dashRouter);
    }

    /**
     * Create a new route with given options.
     *
     * @param  array|\Traversable $options
     * @return void
     */
    public static function factory($options = array())
    {
        // TODO: Implement factory() method.
    }

    /**
     * @return \Dash\Router\Http\Router
     */
    public function getDashRouter()
    {
        return $this->dashRouter;
    }

    /**
     * @param \Dash\Router\Http\Router $dashRouter
     */
    public function setDashRouter(Router $dashRouter)
    {
        $this->dashRouter = $dashRouter;
    }

    /**
     * Match a given request.
     *
     * @param  Request $request
     * @return RouteMatch|null
     */
    public function match(Request $request)
    {
        $dashRouteMatch = $this->dashRouter->match($request);
        if(is_null($dashRouteMatch)) {
            return null;
        }
        $routeMatch = new \Zend\Mvc\Router\Http\RouteMatch($dashRouteMatch->getParams());
        $routeMatch->setMatchedRouteName($dashRouteMatch->getRouteName());

        return $routeMatch;
    }

    /**
     * Assemble the route.
     *
     * @param  array $params
     * @param  array $options
     * @return mixed
     */
    public function assemble(array $params = array(), array $options = array())
    {
        // TODO: Implement assemble() method.
    }

    /**
     * Add a route to the stack.
     *
     * @param  string $name
     * @param  mixed $route
     * @param  int $priority
     * @return RouteStackInterface
     */
    public function addRoute($name, $route, $priority = null)
    {
        // TODO: Implement addRoute() method.
    }

    /**
     * Add multiple routes to the stack.
     *
     * @param  array|\Traversable $routes
     * @return RouteStackInterface
     */
    public function addRoutes($routes)
    {
        // TODO: Implement addRoutes() method.
    }

    /**
     * Remove a route from the stack.
     *
     * @param  string $name
     * @return RouteStackInterface
     */
    public function removeRoute($name)
    {
        // TODO: Implement removeRoute() method.
    }

    /**
     * Remove all routes from the stack and set new ones.
     *
     * @param  array|\Traversable $routes
     * @return RouteStackInterface
     */
    public function setRoutes($routes)
    {
        // TODO: Implement setRoutes() method.
    }

}