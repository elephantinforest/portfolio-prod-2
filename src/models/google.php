<?php
require '/var/www/html/vendor/autoload.php';

use Gemini\Data\Blob;
use Gemini\Enums\MimeType;

class Google
{

  public function getPictureJson($imagePath)
  {
    try {
      $yourApiKey = getenv('API_KEY');
      $client = Gemini::client($yourApiKey);

      $result = $client
        ->geminiProVision()
        ->generateContent([
          'this pocture change into json  it need name and genru and price all are taransleted japanese and ',
          new Blob(
            mimeType: MimeType::IMAGE_JPEG,
            data: base64_encode(
              file_get_contents($imagePath)
            )
          )
        ]);
      $json = $result->text();
      $json = str_replace("`", "", $json);
      $json = str_replace("json", "", $json);
      $array = json_decode($json, true);
      return $array;
    } catch (ValueError) {
      throw new PDOException('読み取りエラー発生！入力フォームを確認してもう一度登録よろしくお願いします。');
    }
  }
}
