<?php

namespace App\Http\Controllers\Frontends;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    
    public function index(){
        return view('frontends.login');
    }
}