<?php

use RedBeanPHP\R as R;

class BaseController
{
    public function getBeanById($typeOfBean, $queryStringKey)
    {
        $bean = null;
        if (isset($_GET[$queryStringKey])) {
            $id = $_GET[$queryStringKey];
            $bean = R::load($typeOfBean, $id);
        } else {
            error(404, 'No ' . $queryStringKey . ' specified');
        }

        return $bean;
    }

    public function codeToImage($code, $langauge, $theme)
    {
        $url = sprintf('http://127.0.0.1:3000/api/to-image?language=%s&theme=%s', $langauge, $theme);

        $requestBody = $code;

        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: text/plain",
                'content' => $requestBody,
            ]
        ];

        $context = stream_context_create($options);

        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            error(500, 'Could not convert code to image');
        }

        return $response;
    }
}
