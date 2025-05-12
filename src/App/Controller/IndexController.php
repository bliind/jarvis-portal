<?php

namespace App\Controller;

use PHPSkel\Controller;
use PHPSkel\Response;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('index.tpl', ['title' => 'Home']);
    }

    public function styleAction()
    {
        $css = file_get_contents(ROOTDIR . '/web/css/colors.css');
        $css .= file_get_contents(ROOTDIR . '/web/css/base.css');
        $css .= file_get_contents(ROOTDIR . '/web/css/utility.css');

        return new Response($css, 200, ['Content-Type' => 'text/css']);
    }
}
