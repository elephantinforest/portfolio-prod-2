<?php
// リクエストするURLを指定
$url = "https://us-central1-aiplatform.googleapis.com/v1/projects/portfolio-414509/locations/us-central1/publishers/google/models/gemini-1.0-pro-vision:streamGenerateContent";

// 送信するデータを指定
$data = array(
  "contents" => array(
    "role" => "user",
    "parts" => array(
      array(
        "fileData" => array(
          "mimeType" => "image/jpeg",
          "fileUri" => "/var/www/html/20231231225342_MG_1327.JPG"
        )
      ),
      array(
        "text" => "Describe this picture."
      )
    )
  )
);

// データをJSON形式にエンコード
$json = json_encode($data);

// cURLセッションを初期化
$ch = curl_init();

// URLとオプションを指定
curl_setopt($ch, CURLOPT_URL, $url); // URL
curl_setopt($ch, CURLOPT_POST, true); // POSTメソッド
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Authorization: Bearer $(gcloud auth application-default print-access-token)", // 認証トークン
  "Content-Type: application/json" // コンテントタイプ
)); // ヘッダー
curl_setopt($ch, CURLOPT_POSTFIELDS, $json); // 送信データ
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

// URLの情報を取得
$response = curl_exec($ch);

// 結果を表示
var_dump($response);

// セッションを終了
curl_close($ch);
