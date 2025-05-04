<?php

namespace PHPSkel;

class Parameters
{
    private $parameters;

    public function __construct()
    {
        $this->parameters = json_decode(file_get_contents(ROOTDIR . '/config/parameters.json'), true);
    }

    public function get($parameter, $default = null)
    {
        if (isset($this->parameters[$parameter])) {
            return $this->parameters[$parameter];
        }

        return $default;
    }

    public function has($parameter)
    {
        return isset($this->parameters[$parameter]);
    }
}
