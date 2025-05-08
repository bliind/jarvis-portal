<?php

namespace App\Database;
use PHPSkel\Parameters;

class JarvisDatabase extends Database {
    public function __construct() {
        $parameters = new Parameters();
        $this->dsn = $parameters->get('jarvis_dsn');

        parent::__construct();
    }

    public function getServers()
    {
        $this->table = 'servers';

        return $this->select();
    }
}
