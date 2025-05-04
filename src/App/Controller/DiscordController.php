<?php

namespace App\Controller;

use PHPSkel\Controller;
use PHPSkel\HttpException;
use PHPSkel\Parameters;
use App\Database\ConfigDatabase;

class DiscordController extends Controller
{
    protected $allowedUsers;
    private $configDatabase;

    public function construct() {
        $this->configDatabase = new ConfigDatabase();
        $parameters = new Parameters();
        $this->allowedUsers = $parameters->get('allowed_users');
    }

    public function authPageAction()
    {
        // render a template that can use javascript to get the url fragment
        // since PHP literally cannot see that part of the url
        return $this->render('discord/auth.tpl');
    }

    public function postUserDataAction()
    {
        // read the data from the fragment passed in from authPageAction
        $postData = $this->request->post->all();
        $_SESSION['accessToken'] = $postData['accessToken'];
        $_SESSION['tokenType'] = $postData['tokenType'];
        $_SESSION['expiresAt'] = $postData['expiresAt'];
        $_SESSION['discordID'] = $postData['discordID'];
        $_SESSION['username'] = $postData['username'];
        $_SESSION['global_name'] = $postData['global_name'];
        $_SESSION['avatar'] = $postData['avatar'];
    }

    public function dashboardAction()
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

        $configs = $this->configDatabase->select();
        $pageData = [
            'title' => 'Dashboard',
            'configs' => $configs,
        ];
        return $this->render('dashboard/dashboard.tpl', $pageData);
    }

    public function logoutAction()
    {
        session_unset();

        $pageData = [
            'logout' => true,
            'title' => 'Logged Out'
        ];

        return $this->render('site/logout.tpl', $pageData);
    }
}

