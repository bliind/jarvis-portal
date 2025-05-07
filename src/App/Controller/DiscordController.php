<?php

namespace App\Controller;

use PHPSkel\Controller;

class DiscordController extends Controller
{
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

