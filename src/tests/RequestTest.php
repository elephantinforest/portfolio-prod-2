<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/Request.php';


/**
 * @covers summary
 */
class RequestTest extends TestCase
{
    protected $request;

    protected function setUp(): void
    {
        $this->request = new Request();
    }

    protected function tearDown(): void
    {
        $this->request = null;
    }
    public function testIsPost()
    {
        // テスト用のコンテンツを設定
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertTrue($this->request->isPost());
    }

    public function testGetPathInfo()
    {
        // テスト用のリクエストURIを設定
        $uri = '/example/path';
        $_SERVER['REQUEST_URI'] = $uri;

        // テスト対象のメソッドを呼び出して戻り値を検証
        $result = $this->request->getPathInfo();

        // 期待される結果を検証
        $this->assertEquals($uri, $result);
    }
}
