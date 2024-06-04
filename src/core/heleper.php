<?php


class  heleper
{
  private $isTest = false;

  public function handleError($errors)
  {
    $response = ['success' => false, 'errors' => $errors];
    header('Content-Type: application/json');
    echo json_encode($response);
    if (!$this->isTest) {
      exit();
    }
  }

  public function sendResponse($data)
  {
    header('Content-Type: application/json');
    echo json_encode($data);
    if (!$this->isTest) {
      exit();
    }
  }

  public function createPath(string $path): string
  {
    $imagePath = $path;
    $binaryData = file_get_contents($imagePath);
    $base64Data = base64_encode($binaryData);

    // MIMEタイプの取得
    $mimeType = mime_content_type($imagePath);

    // Base64エンコードされたデータを含むデータURIを生成
    $dataUri = 'data:' . $mimeType . ';base64,' . $base64Data;

    return $dataUri;
  }
  public function  crateRegisterSaveFile(string $file)
  {
    $upload_dir = '/var/www/html/src/imgs/register/';
    $saveFileName = date('YmdHis') . $file;
    $savePath = $upload_dir . $saveFileName;
    return $savePath;
  }
  public function  crateLocationSaveFile(string $file)
  {
    $upload_dir = '/var/www/html/src/imgs/location/';
    $saveFileName = date('YmdHis') . $file;
    $savePath = $upload_dir . $saveFileName;
    return $savePath;
  }

  public function isTestTrue()
  {
    $this->isTest = true;
  }

  public function changeSize(array $registers, array $size)
  {
    $currentWidth = $size['windowWidth'];
    $currentHeight = $size['windowHeight'];
    foreach ($registers as $num => $value) {
      $data = [
        'width' => $value['width'],
        'height' => $value['height'],
        'top_position' => $value['top_position'],
      ];
      $registerWidth = $value['window_width'];
      $registerHeight = $value['window_height'];
      $scaleX = $currentWidth / $registerWidth;
      $scaleY = $currentHeight / $registerHeight;
      foreach ($data as $key => $value) {
        if ($key === 'width') {
          $registers[$num][$key] = $value * $scaleX;
        } elseif ($key === 'height') {
          $registers[$num][$key] = $value * $scaleY;
        } elseif ($key === 'top_position') {
          $registers[$num][$key] = $value * $scaleY;
        }
      }
    }
    return $registers;
  }
}
