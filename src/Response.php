<?php
declare(strict_types=1);

namespace App;

final class Response {
    private $statusCode;
    private $headers;
    private $body;

    public function __construct($statusCode, $body = '', $headers = []) {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function getBody() {
        return $this->body;
    }

    public function setHeader($name, $value) {
        $this->headers[$name] = $value;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function send() {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->body;
    }

    public static function redirect($url, $statusCode = 302) {
        $response = new Response($statusCode);
        $response->setHeader('Location', $url);
        $response->send();
    }
}
