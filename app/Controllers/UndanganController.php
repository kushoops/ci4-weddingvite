<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UndanganController extends BaseController
{
    public function index()
    {
        //
    }

    public function orange10()
    {
        return view('undangan/orange_10.html');
    }
}
