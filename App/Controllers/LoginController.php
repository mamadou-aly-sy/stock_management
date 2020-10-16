<?php
namespace App\Controllers;

use App\Models\Admin;
use Core\Controller;
use Core\Session;

class LoginController extends Controller
{
    public function index()
    {
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            $user     = Admin::login($username, $password);
            if ($user) {
                Session::set('user_id', $user->id);
                $this->redirect('admin');
            }
        }
        $this->render('home/login');
    }
}
