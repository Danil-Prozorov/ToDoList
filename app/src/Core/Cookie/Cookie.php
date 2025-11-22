<?php

namespace App\Core\Cookie;

class Cookie
{
    public function setCookie($name, $value, $expires = 0, $path = '/', $domain = '', $secure = false, $httponly = false): void
    {
        setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
    }

    public function getCookie($name): string
    {
        return $_COOKIE[$name];
    }

    public function getAllCookies(): array
    {
        return $_COOKIE;
    }

    public function deleteCookie($name): void
    {
        setcookie($name, '', time() - 3600, '/');
    }
}
