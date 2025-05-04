<?php

namespace PHPSkel;

class Request
{
    private $uri;
    private $method;
    private $post;
    private $get;
    private $files;
    private $cookies;

    public function __construct($uri, $method, $post, $get, $files, $cookies)
    {
        $this->uri = substr($uri, 0, (strpos($uri, '?') ?: strlen($uri)));
        $this->method = $method;
        $this->post = new Bucket($post);
        $this->get = new Bucket($get);
        $this->files = $files;
        $this->cookies = new Bucket($cookies);
    }

    public function __get($key)
    {
        if (isset($this->$key)) {
            return $this->$key;
        }
    }

    public static function generate()
    {
        $headers = \getallheaders();
        $post = $_POST;
        if (isset($headers['Content-Type']) && $headers['Content-Type'] == 'application/json') {
            try {
                $post = json_decode(file_get_contents('php://input'), true, 512, JSON_BIGINT_AS_STRING);
            } catch (\Exception $e) {}
        }

        return new self(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD'],
            $post,
            $_GET,
            $_FILES,
            $_COOKIE
        );
    }

    /**
     * Get the value of uri
     */ 
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the value of post
     */ 
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Get the value of get
     */ 
    public function getGet()
    {
        return $this->get;
    }

    /**
     * Get the value of files
     */ 
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Get the value of cookies
     */ 
    public function getCookies()
    {
        return $this->cookies;
    }
}
