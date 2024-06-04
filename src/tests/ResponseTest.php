<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/Response.php';

/**
 * @covers summary
 */
class ResponseTest extends TestCase
{
    protected $response;

    protected function setUp(): void
    {
        $this->response = new Response();
    }

    public function testSetContent()
    {

        // テスト用のコンテンツを設定
        $content = 'Test content';
        $this->response->setContent($content);

        // コンテンツが正しく設定されたことを確認
        $this->assertEquals($content, $this->response->getContent());
    }
    public function testSetStatusCode()
    {
        $this->response->setStatusCode(404, 'Not Found');

        $this->assertEquals(404, $this->response->getStatusCode());
        $this->assertEquals('Not Found', $this->response->getStatusText());
    }

   
    public function testSend()
    {
        $this->response->setContent('Test content');
        $this->response->setStatusCode(200, 'OK');

        // キャプチャするために出力をバッファリング
        ob_start();
        $this->response->send();
        $output = ob_get_clean();

        // 期待される出力を確認
        $this->assertEquals('Test content', $output);

        // ステータスコードが正しいかどうかを確認
        // $this->assertStringContainsString('200 OK', $this->getHeader('HTTP/1.1'));
        ob_clean();
    }


    protected function tearDown(): void
    {
        $this->response = null;
    }
}
