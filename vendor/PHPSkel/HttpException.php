<?php

namespace PHPSkel;

use \Exception;

class HttpException extends Exception
{
    protected $response;

    public function __construct($message = null, $code = 500, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $template = new Template('error/' . $code . '.tpl');
        $request = Request::generate();
        $templateData = [
            'request' => $request,
            'title' => $code,
        ];

        if (isset($_SESSION['discordID'])) {
            $templateData['user'] = [
                'discordID'   => $_SESSION['discordID'],
                'username'    => $_SESSION['username'],
                'global_name' => $_SESSION['global_name'],
                'avatar'      => $_SESSION['avatar'],
            ];
        }
        $this->response = new Response($template->render($templateData), $code);
    }

    public function getResponse()
    {
        return $this->response;
    }
}
