<?php

namespace PHPSkel;

class Session extends Bucket
{
    public function set($key, $value)
    {
        $this->bucket[$key] = $value;
        $_SESSION[$key] = $value;
    }
}
