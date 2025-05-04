<?php

namespace App\Controller;

use PHPSkel\Controller;
use PHPSkel\HttpException;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('index.tpl', ['title' => 'Home']);
    }
}
