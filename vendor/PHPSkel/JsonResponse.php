<?php

namespace PHPSkel;

class JsonResponse extends Response
{
    protected function setContent($content)
    {
        $this->content = json_encode($content);
        $this->headers->set('Content-Type', 'application/json');
    }
}
