<?php

namespace PHPSkel;

class Parameters
{
    private $parameters;

    public function __construct()
    {
        $yaml = new Yaml();
        $this->parameters = $yaml->load(ROOTDIR . '/config/parameters.yml');
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
