<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page_title'        => 'Welcome to Projectwiz',
            'navi_group'        => 'dashboard'
        ];

        return view('pages.dashboard', $data);
    }
}
