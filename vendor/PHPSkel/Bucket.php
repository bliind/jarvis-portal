<?php

namespace PHPSkel;

class Bucket
{
    protected $bucket = [];

    public function __construct(array $bucket = [])
    {
        foreach ($bucket as $key => $value) {
            $this->set($key, $value);
        }
    }

    public function all()
    {
        return $this->bucket;
    }

    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $this->bucket[$key];
        }

        return $default;
    }

    public function has($key)
    {
        return (isset($this->bucket[$key]));
    }

    public function set($key, $value)
    {
        $this->bucket[$key] = $value;
    }
}
