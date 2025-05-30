<?php

namespace App\Service;

class DiscordService
{
    private $baseUrl = 'https://discord.com/api';

    public function getGuilds($token)
    {
        $response = $this->curl($token, '/users/@me/guilds');

        $out = [];
        foreach ($response['response'] as $guild) {
            $out[] = [
                "id" => $guild['id'],
                "name" => $guild['name'],
                "icon" => $guild['icon'],
            ];
        }

        return $out;
    }

    private function curl($token, $endpoint, $method = 'GET', $parameters = [])
    {
        $curl = curl_init($this->baseUrl . $endpoint);
        $curl_opts = [
            CURLOPT_CUSTOMREQUEST  => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $token
            ],
        ];

        if (!empty($parameters)) {
            $curl_opts[CURLOPT_POSTFIELDS] = json_encode($parameters);
        }
        curl_setopt_array($curl, $curl_opts);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return [
            'httpcode' => $httpcode,
            'response' => json_decode($response),
        ];
    }
}
