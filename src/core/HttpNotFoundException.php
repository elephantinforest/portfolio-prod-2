<?php


class HttpNotFoundException extends Exception
{
    public function render404Page(Response $response): Response
    {

        $response->setStatusCode(404, 'Not Found');
        $response->setContent(
            <<<EOF
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
EOF
        );
        return $response;
    }

}
