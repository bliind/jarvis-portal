<?php

namespace PHPSkel;

class Controller
{
    protected $request;
    protected $requiresAuth = false;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->construct();
    }

    // a place to put construct things without overriding construct
    public function construct() {}

    // override to add authentication
    protected function checkUser()
    {
        return true;
    }

    public function render(string $templateName, array $data = [], int $status = 200)
    {
        $template = new Template($templateName);

        $data['request'] = $this->request;
        if (isset($_SESSION['discordID'])) {
            $data['user'] = [
                'discordID'   => $_SESSION['discordID'],
                'username'    => $_SESSION['username'],
                'global_name' => $_SESSION['global_name'],
                'avatar'      => $_SESSION['avatar'],
            ];
        }

        return new Response($template->render($data), $status);
    }

    public function runAction($action, $parameters = [])
    {
        $actionName = $action . 'Action';
        if (method_exists($this, $actionName)) {
            if ($this->requiresAuth) {
                $authResponse = $this->checkUser();
                if ($authResponse !== true) return $authResponse;
            }

            // converts parameters to int if applicable
            foreach ($parameters as $key => &$value) {
                if (\ctype_digit($value)) $value = (int) $value;
            }

            $response = $this->$actionName(...$parameters);
        } else {
            throw new HttpException(null, 500);
        }

        return $response;
    }
}
