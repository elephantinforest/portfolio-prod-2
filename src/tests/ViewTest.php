<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/View.php';

/**
 * @covers summary
 */
class ViewTest extends TestCase
{
    protected $view;

    protected function setUp(): void
    {
        $this->view  = new View(__DIR__ . '/../src/views');
    }

    public function testConstruct()
    {
        $expected = __DIR__ . '/../src/views';
        $actual =  $this->view->getBasedir();

        $this->assertSame($expected, $actual);
    }

    public function testGetBasedir()
    {
        $expected = __DIR__ . '/../src/views';
        $actual =  $this->view->getBasedir();

        $this->assertSame($expected, $actual);
    }

    public function testRender()
    {
        $path = 'tests/testUser';
        $layout = 'layoutTest';
        $locations = ['locations' => [
            'location_id' => 1,
            'file_path' => '/var/www/html/src/imgs/_b4eb111d-3415-4e44-8ad7-8155acc5a0b8.jpg',
        ]];
        $actual = $this->view->render($path, $locations, $layout);
        $expected = "ハローワールド" . "\n";
        $this->assertSame($expected, $actual);
    }

    protected function tearDown(): void
    {
        $this->view = null;
    }
}
