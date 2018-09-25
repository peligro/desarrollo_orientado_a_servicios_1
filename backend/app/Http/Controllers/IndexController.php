<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class IndexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('index.index');
        }else
        {
            return redirect('/acceso/login');
        }
    }
    
}