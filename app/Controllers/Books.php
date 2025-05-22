<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    public function index()
    {
        //$books = $this->bookModel->findAll();
        $data = [
            'title' => 'Daftar Buku',
            'books' => $this->bookModel->getBook()

        ];

        return view('books/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Buku',
            'book' => $this->bookModel->getBook($slug)
        ];

        if (empty($data['book'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku' . $slug . 'Tidak ditemukan');
        }

        return view('books/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'validation' => \config\Services::validation(),
        ];
        return view('books/tambah', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah dimasukkan',
                ]
            ]
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to(base_url() . '/books/tambah')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bookModel->save([
            'judul' => $this->request->getVAR('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVAR('penulis'),
            'penerbit' => $this->request->getVAR('penerbit'),
            'sampul' => $this->request->getVAR('sampul'),
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/books');
    }

    public function delete($id)
    {
        $this->bookModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/books');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data Buku',
            'validation' => \config\Services::validation(),
            'book' => $this->bookModel->getBook($slug)
        ];
        return view('books/edit', $data);
    }
    public function update($id)
    {
        $bukulama = $this->bookModel->getBook($this->request->getVar('slug'));
        if ($bukulama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[books.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field}buku harus diisi',
                    'is_unique' => '{field}buku sudah dimasukkan'
                ]
            ]
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/books/edit' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '', true);
        $this->bookModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/books');
    }
}
