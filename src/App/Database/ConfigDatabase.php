<?php

namespace App\Database;
use PHPSkel\Parameters;

class ConfigDatabase extends Database {
    public function __construct() {
        $parameters = new Parameters();
        $this->dsn = $parameters->get('config_dsn');
        $this->table = 'config';

        parent::__construct();
    }
}
