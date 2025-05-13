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

    public function sortChannels($a, $b)
    {
        if ($a->channel_position > $b->channel_position) {
            return 1;
        } elseif ($a->channel_position < $b->channel_position) {
            return -1;
        }
        return 0;
    }

    public function getChannels($server)
    {
        $parts = ['where' => 'WHERE server = :server'];
        $bind = [':server' => (int)$server];

        $dbChans = $this->select($parts, $bind);

        $channels = [];
        // isolate the categories and sort them
        $categories = array_filter($dbChans, function($e) { return $e->type == 'CATEGORY'; });
        usort($categories, function($a, $b) { return $this->sortChannels($a, $b); });

        // create a searchable list of category name to id
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category->channel_name] = $category->channel_id;
            // also add to output array
            $channels[$category->channel_name] = [];
        }

        // add channels to output arrays under their parents
        foreach ($dbChans as $channel) {
            if (!is_null($channel->parent_id)) {
                $parentName = array_search($channel->parent_id, $cats);
                $channels[$parentName][] = $channel;
            } // TODO: handle else
        }

        foreach ($channels as $category => &$chans) {
            usort($chans, function($a, $b) { return $this->sortChannels($a, $b); });
        }

        return $channels;
    }
}
