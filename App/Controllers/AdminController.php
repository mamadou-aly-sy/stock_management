<?php
namespace App\Controllers;

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
    public function index()
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
}
