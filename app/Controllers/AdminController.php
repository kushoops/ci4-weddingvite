<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        //
    }

    public function mempelai()
    {
        return view('admin/mempelai.html');
    }

    public function tambahMempelai()
    {
        return view('admin/tambah_mempelai.html');
    }

    public function dataUndangan()
    {
        return view('admin/data_undangan.html');
    }

    public function tamu()
    {
        return view('admin/tamu.html');
    }

    public function tambahTamu()
    {
        return view('admin/tambah_tamu.html');
    }

    public function undangan()
    {
        return view('admin/undangan.html');
    }

    public function tambahUndangan()
    {
        return view('admin/tambah_undangan.html');
    }

    public function profile()
    {
        return view('admin/profile.html');
    }
}
