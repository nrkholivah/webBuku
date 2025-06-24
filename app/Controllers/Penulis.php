<?php

namespace App\Controllers;

use App\Models\PenulisModel;
use CodeIgniter\CodeIgniter;
use PSpell\Config;

class Penulis extends BaseController
{
    protected $penulisModel;

    public function __construct()
    {
        $this->penulisModel = new PenulisModel();
    }

    public function index()
    {
        $kataKunci = $this->request->getVar('keyword');
        if ($kataKunci) {
            $penulis = $this->penulisModel->search($kataKunci);
        } else {
            $penulis = $this->penulisModel;
        }

        $pageSekarang = $this->request->getVar('page_penulis') ? $this->request->getVar('page_penulis') : 1;

        $data = [
            'title' => 'Daftar Penulis',
            //'penulis' => $this->penulisModel->findAll(),
            'penulis' => $this->penulisModel->paginate(10, 'penulis'),
            'pager' => $this->penulisModel->pager,
            'pageSekarang' => $pageSekarang
        ];
        return view('penulis/index', $data);
    }

    public function create()
    {
        return view('penulis/create');
    }
}
