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
        $parts = [
            'select' => '
                SELECT
                    config.server,
                    config.key,
                    config.value,
                    channels.channel_id,
                    channels.channel_name,
                    channels.type,
                    channels.parent_id,
                    roles.role_id,
                    roles.role_name,
                    roles.role_position,
                    roles.role_icon,
                    roles.role_color1,
                    roles.role_color2,
                    roles.role_color3
            ',
            'where' => 'WHERE config.server = :server',
            'join' => '
                LEFT JOIN roles ON roles.role_id = config.value AND roles.server = config.server
                LEFT JOIN channels ON channels.channel_id = config.value AND channels.server = config.server
            ',
        ];
        $bind = [':server' => (int)$server];

        $rows = $this->select($parts, $bind);
        $out = [];
        foreach ($rows as $row) {
            // plural key name means multiple entries
            if (substr($row->key, -1, 1) == 's') {
            if (!isset($out[$row->key])) {
                    $out[$row->key] = [];
                }
                $out[$row->key][] = $row;
            } else {
                $out[$row->key] = $row;
            }
        }

        return $out;
    }
}

