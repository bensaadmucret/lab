<?php
declare(strict_types=1);

namespace App;




final class Request {
    private static $queryParams;
    private static $postData;
    private static $headers;
    private static $cookies;
    private static $method;
    private static $path;

    public static function init() {
        self::$queryParams = $_GET;
        self::$postData = $_POST;
        self::$headers = self::getAllHeaders();
        self::$cookies = $_COOKIE;
    }

    public static function getMethod(): string {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getPath(): string {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public static function getQueryParams(): array {
        return $_GET ?? [];
    }

    public static function getPostData(): array {
        return $_POST ?? [];
    }

    public static function getHeaders(): array {
        return self::$headers ?? [];
    }

    public static function getCookies(): array {
        return self::$cookies ?? [];
    }

    public static function hasQueryParam(string $key): bool {
        return array_key_exists($key, self::$queryParams);
    }

    public static function hasPostData(string $key): bool {
        return array_key_exists($key, self::$postData);
    }

    public static function hasHeader(string $key): bool {
        return array_key_exists(strtolower($key), self::$headers);
    }

    public static function hasCookie(string $key): bool {
        return array_key_exists($key, self::$cookies);
    }

    public static function getQueryParam(string $key, $default = null) {
        return self::hasQueryParam($key) ? self::$queryParams[$key] : $default;
    }

    public static function getPostValue(string $key, $default = null) {
        return self::hasPostData($key) ? self::$postData[$key] : $default;
    }

    public static function getHeaderValue(string $key, $default = null) {
        $key = strtolower($key);
        return self::hasHeader($key) ? self::$headers[$key] : $default;
    }

    public static function getCookieValue(string $key, $default = null) {
        return self::hasCookie($key) ? self::$cookies[$key] : $default;
    }

    private static function getAllHeaders(): array {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) === 'HTTP_') {
                $headers[strtolower(substr($key, 5))] = $value;
            }
        }
        return $headers;
    }
}

