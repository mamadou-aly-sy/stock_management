<?php
namespace App\Controllers;

use Core\Controller;
use Core\Session;

class HomeController extends Controller
{
    public function index()
    {
        if (Session::contain('user_id')) {
            $this->redirect('admin/dashboard');
        }

        $this->render('home/home');
    }
}
