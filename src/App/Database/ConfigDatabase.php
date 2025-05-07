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

    public function getConfigs($server)
    {
        $parts = ['where' => 'WHERE server = :server'];
        $bind = [':server' => (int)$server];

        $rows = $this->select($parts, $bind);
        $out = [];
        foreach ($rows as $row) {
            if (!isset($out[$row->key])) $out[$row->key] = [];
            $out[$row->key][] = $row->value;
        }

        return $out;
    }
}
