<?php

class CreatePath
{
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
}
