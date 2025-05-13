<?php

namespace App\Database;
use PHPSkel\Parameters;

class JarvisChannelDatabase extends Database {
    public function __construct() {
        $parameters = new Parameters();
        $this->dsn = $parameters->get('config_dsn');
        $this->table = 'channels';

        parent::__construct();
    }

    public function getChannels($server)
    {
        $parts = ['where' => 'WHERE server = :server'];
        $bind = [':server' => (int)$server];

        return $this->select($parts, $bind);
    }
}
