<?php

namespace PHPSkel;

class Response
{
    protected $headers;
    protected $content;
    protected $statusCode;
    protected $statusText;

    public $charset = 'UTF-8';
    public $version = '1.1';

    protected $statusCodeTexts = [
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
    ];

    public function __construct($content = '', int $status = 200, array $headers = [])
    {
        $this->headers = new Bucket($headers);
        $this->setContent($content);
        $this->setStatus($status);
    }

    protected function setContent($content)
    {
        $this->content = $content;
    }

    protected function setStatus($status)
    {
        $this->statusCode = $status;
        $this->statusText = $this->statusCodeTexts[$status] ?: '';
    }

    /**
     * Generate a response from a file
     * 
     * @param string $file
     * @return Response
     */
    public static function fromFile(string $file)
    {
        $contentTypes = [
            'css' => 'text/css;charset=utf-8',
            'js'  => 'application/x-javascript;charset=utf-8',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'jpg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon'
        ];

        $headers = [];
        preg_match('/\.([^\.]+)$/', $file, $matches);

        // if we can match the extension, apply the content type
        if (isset($matches[1]) && isset($contentTypes[$matches[1]])) {
            $headers['Content-Type'] = $contentTypes[$matches[1]];
        }

        return new self(file_get_contents($file), 200, $headers);
    }

    public function send()
    {
        if (!$this->headers->has('Content-Type')) {
            $this->headers->set('Content-Type', 'text/html;charset=' . $this->charset);
        }

        foreach ($this->headers->all() as $header => $value) {
            header($header . ': ' . $value);
        }

        header(sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusText));

        echo $this->content;
    }
}
