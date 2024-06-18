<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MempelaiController extends BaseController
{
    public function index()
    {
        //
    }

    public function tamu()
    {
        return view('mempelai/tamu.html');
    }

    public function tambahTamu()
    {
        return view('mempelai/tambah_tamu.html');
    }

    public function undangan()
    {
        return view('mempelai/undangan.html');
    }

    public function dataUndangan()
    {
        return view('mempelai/data_undangan.html');
    }

    public function pesanKiriman()
    {
        return view('mempelai/pesan_kiriman.html');
    }

    public function rsvp()
    {
        return view('mempelai/rsvp.html');
    }

    public function ucapan()
    {
        return view('mempelai/ucapan.html');
    }

    public function profile()
    {
        return view('mempelai/profile.html');
    }
}
