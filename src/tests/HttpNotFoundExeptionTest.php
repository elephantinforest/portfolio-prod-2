<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/HttpNotFoundException.php';
require_once __DIR__ . '/../core/Response.php';


/**
 * @covers summary
 */
class HttpNotFoundExceptionTest extends TestCase
{
    protected $response;
    protected $httpnotfoundexception;

    protected function setUp(): void
    {
        $this->response = new Response();
        $this->httpnotfoundexception = new  HttpNotFoundException();
    }

    protected function tearDown(): void
    {
        $this->response = null;
    }
    public function testRender404Page()
    {
        $response = $this->httpnotfoundexception->render404Page($this->response);
        // テスト用のコンテンツを設定

        $actualStatusCode = $this->response->getStatusCode();
        $actualStatusText = $this->response->getStatusText();
        $actualContent = $this->response->getContent();

        $expectedStatusCode = 404;
        $expectedStatusText = 'Not Found';
        $expectedContent = <<<EOF
<!DOCTYPE html>
    <html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    </head>
    <body>
        <h1>
            404 Page Not Found.
        </h1>
    </body>
</html>
EOF;

        // コンテンツが正しく設定されたことを確認
        $this->assertEquals($expectedContent, $actualContent);
        $this->assertEquals($expectedStatusCode, $actualStatusCode);
        $this->assertEquals($expectedStatusText, $actualStatusText);
    }
}
