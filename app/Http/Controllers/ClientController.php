<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ClientController extends Controller
{
    public function index()
    {
        $data = [
            'page_title'        => 'View All Clients',
            'navi_group'        => 'clients',
            'navi_submenu'      => 'index'
        ];

        return view('clients.index', $data);
    }
}
