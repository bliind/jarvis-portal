<?php

namespace App\Database;
use PHPSkel\Parameters;

class JarvisServerDatabase extends Database {
    public function __construct() {
        $parameters = new Parameters();
        $this->dsn = $parameters->get('jarvis_dsn');
        $this->table = 'servers';

        parent::__construct();
    }

    public function getServer($serverID)
    {
        $parts = ['where' => 'WHERE server_id = :serverID'];
        $bind = [':serverID' => (int)$serverID];

        return $this->select($parts, $bind);
    }
}
