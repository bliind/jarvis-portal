<?php

namespace App\Controller;

use PHPSkel\Controller;
use PHPSkel\HttpException;
use PHPSkel\Parameters;
use App\Database\ConfigDatabase;
use App\Database\JarvisServerDatabase;
use App\Database\JarvisChannelDatabase;
use App\Database\JarvisRoleDatabase;

class DashboardController extends Controller
{
    protected $requiresAuth = true;
    protected $allowedUsers;
    private $jarvisServerDatabase;
    private $jarvisChannelDatabase;
    private $jarvisRoleDatabase;
    private $configDatabase;

    public function construct() {
        $this->jarvisServerDatabase = new JarvisServerDatabase();
        $this->jarvisChannelDatabase = new JarvisChannelDatabase();
        $this->jarvisRoleDatabase = new JarvisRoleDatabase();
        $this->configDatabase = new ConfigDatabase();

        $parameters = new Parameters();
        $this->allowedUsers = $parameters->get('allowed_users');
    }

    protected function checkUser()
    {
        $noToken = empty($_SESSION['accessToken']);
        if ($noToken) {
            return $this->render('dashboard/login.tpl', ['title' => 'Login']);
        }

        if (!$noToken) {
            $notAllowed = !in_array((int)$_SESSION['discordID'], $this->allowedUsers);
            if ($notAllowed) {
                throw new HttpException(null, 403);
            }

            if ($_SESSION['expiresAt'] < time()) {
                return $this->render('dashboard/login.tpl', ['title' => 'Login']);
            }
        }

        return true;
    }

    public function dashboardAction()
    {
        $pageData = [
            'title'   => 'Select',
            'servers' => $this->jarvisServerDatabase->select(),
        ];

        return $this->render('dashboard/landing.tpl', $pageData);
    }

    public function serverDashboardAction($server)
    {
        $roles = $this->jarvisRoleDatabase->getRoles($server);
        // sort by role.position, backwards
        usort($roles, function($a, $b) {
            if ($a->position < $b->position) {
                return 1;
            } elseif ($a->position > $b->position) {
                return -1;
            }

            return 0;
        });

        $pageData = [
            'title'    => 'Dashboard',
            'server'   => $this->jarvisServerDatabase->getServer($server),
            'channels' => $this->jarvisChannelDatabase->getChannels($server),
            'roles'    => $roles,
            'configs'  => $this->configDatabase->getConfigs($server),
        ];

        return $this->render('dashboard/serverDashboard.tpl', $pageData);
    }
}
