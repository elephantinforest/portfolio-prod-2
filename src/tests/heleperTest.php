<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../core/heleper.php';

/**
 * @covers summary
 */
class heleperTest extends TestCase
{
    protected $heleper;

    protected function setUp(): void
    {
        $this->heleper = new heleper();
    }


    public function testCreatePath()
    {
        // 画像ファイルのパス
        $imagePath = '/var/www/html/src/imgs/test.jpg'; // テスト用の画像ファイルのパスに置き換える

        // テスト用の画像ファイルの内容
        $imageData = 'Test image data'; // 仮の画像データ

        // 画像ファイルの内容をファイルに書き込む（仮の処理）
        file_put_contents($imagePath, $imageData);

        // テスト対象のメソッドを呼び出す
        $result = $this->heleper->createPath($imagePath);

        // 期待される結果を検証する
        $this->assertStringStartsWith('data:text/plain;base64,VGVzdCBpbWFnZSBkYXRh', $result); // MIMEタイプとBase64エンコードされたデータが含まれているかを検証する

        // テストが完了したら、テスト用の画像ファイルを削除する
        unlink($imagePath);
    }

    protected function tearDown(): void
    {
        $this->heleper = null;
    }
}
