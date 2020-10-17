<?php
namespace App\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Core\Controller;
use Core\Session;

/**
 * Administration class
 */
class AdminController extends Controller
{
    /**
     * Admin Dashbord
     *
     * @return void
     */
    public function dashboard()
    {
        if (!Session::contain('user_id')) {
            $this->redirect('');
        }

        $products = Product::all();
        $this->render('admin/dashboard', compact('products'));
    }

    /**
     * Admin logout
     *
     * @return void
     */
    public function logout()
    {
        Session::remove('user_id');
        $this->redirect('');
    }

    public function login()
    {
        if (Session::contain('user_id')) {
            $this->redirect('admin/dashboard');
        }

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            $user     = Admin::login($username, $password);
            if ($user) {
                Session::set('user_id', $user->id);
                $this->redirect('admin/dashboard');
            }
        }
        $this->render('admin/login');
    }
}
