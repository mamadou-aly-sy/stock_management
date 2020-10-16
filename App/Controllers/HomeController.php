<?php
namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index($name = null)
    {
        $this->render('home/index', compact('name'));
    }
}
