<?php

namespace App\Database;
use PHPSkel\Parameters;

class JarvisRoleDatabase extends Database {
    public function __construct() {
        $parameters = new Parameters();
        $this->dsn = $parameters->get('config_dsn');
        $this->table = 'roles';

        parent::__construct();
    }

    public function getRoles($server)
    {
        $parts = ['where' => 'WHERE server = :server'];
        $bind = [':server' => (int)$server];

        return $this->select($parts, $bind);
    }
}
