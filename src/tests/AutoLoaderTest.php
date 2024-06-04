<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/AutoLoader.php';

/**
 * @covers summary
 */
class AutoLoaderTest extends TestCase
{
    protected $autoLoader;

    protected function setUp(): void
    {
        $this->autoLoader = new AutoLoader();
    }

    public function testLoadClass()
    {
        $this->autoLoader->registerDir('/../core/AutoLoader.php');

        $this->autoLoader->loadClass('AutoLoader');
        $this->assertTrue(class_exists('AutoLoader'));
    }

    protected function tearDown(): void
    {
        $this->autoLoader = null;
    }
}
