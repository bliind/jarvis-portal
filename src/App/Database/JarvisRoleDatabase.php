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

        $roles = $this->select($parts, $bind);

        // sort by role.position, backwards
        usort($roles, function($a, $b) {
            if ($a->role_position < $b->role_position) {
                return 1;
            } elseif ($a->role_position > $b->role_position) {
                return -1;
            }

            return 0;
        });

        return $roles;
    }
}
