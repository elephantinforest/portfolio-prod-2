<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/Router.php';

/**
 * @covers summary
 */
class RouterTest extends TestCase
{
    protected $router;

    protected function setUp(): void
    {
        $this->router  = new Router();
    }

    public function testResolve()
    {
        $actual = $this->router->resolve('/acount');
        $expected = ['controller' => 'Acount', 'action' => 'index'];
        $this->assertSame($expected, $actual);

        $actual = $this->router->resolve('/update?location_id=1');
        $expected = ['controller' => 'Update', 'action' => 'return'];
        $this->assertSame($expected, $actual);

        $actual = $this->router->resolve('/update?id=1');
        $expected = ['controller' => 'Update', 'action' => 'index'];
        $this->assertSame($expected, $actual);

        $actual = $this->router->resolve('/search?search=サンプル');
        $expected = ['controller' => 'Search', 'action' => 'index'];
        $this->assertSame($expected, $actual);

        $actual = $this->router->resolve('/prev?locationId=1');
        $expected = ['controller' => 'Locations', 'action' => 'return'];
        $this->assertSame($expected, $actual);

        $actual = $this->router->resolve('/next?locationId=1');
        $expected = ['controller' => 'Locations', 'action' => 'return'];
        $this->assertSame($expected, $actual);
    }

    public function testRegisterRoutes() {
        $actual = $this->router->getRoutes();
        $expected =
        [
            '/acount' => ['controller' => 'Acount', 'action' => 'index'],
            '/acount/create' => ['controller' => 'Acount', 'action' => 'create'],
            '/login' => ['controller' => 'Login', 'action' => 'index'],
            '/logout' => ['controller' => 'Logout', 'action' => 'index'],
            '/user' => ['controller' => 'Login', 'action' => 'user'],
            '/register' => ['controller' => 'Register', 'action' => 'index'],
            '/register/location' => ['controller' => 'Register', 'action' => 'update'],
            '/register/name' => ['controller' => 'Register', 'action' => 'name'],
            '/position' => ['controller' => 'Position', 'action' => 'index'],
            '/locationupload' => ['controller' => 'Locations', 'action' => 'index'],
            '/update' => ['controller' => 'Update', 'action' => 'update'],
            '/delete' => ['controller' => 'Delete', 'action' => 'delete'],
            '/pagenation' => ['controller' => 'Pagenation', 'action' => 'index'],
            '/resize' => ['controller' => 'Resize', 'action' => 'index'],
        ];
        $this->assertSame($actual,$expected);
    }

    protected function tearDown(): void
    {
        $this->router = null;
    }
}
