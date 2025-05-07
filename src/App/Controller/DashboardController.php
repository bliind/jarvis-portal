<?php

namespace App\Controller;

use PHPSkel\Controller;
use PHPSkel\HttpException;
use PHPSkel\Parameters;
use App\Database\ConfigDatabase;

class DashboardController extends Controller
{
    protected $requiresAuth = true;
    protected $allowedUsers;
    private $configDatabase;

    public function construct() {
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
        $pageData = [];
        return $this->render('dashboard/landing.tpl', $pageData);
    }

    public function serverDashboardAction($server)
    {
        $configs = $this->configDatabase->getConfigs($server);

        $pageData = [
            'title' => 'Dashboard',
            'configs' => $configs,
        ];

        return $this->render('dashboard/serverDashboard.tpl', $pageData);
    }
}
