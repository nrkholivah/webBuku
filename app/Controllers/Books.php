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
        $data = [
            'title' => 'Daftar Buku',
            'books' => $this->bookModel->getBook()
        ];
        return view('books/index', $data);
    }


    public function detail($slug)
    {
        $data['book'] = $this->bookModel->getBook($slug);

        if (empty($data['book'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku ' . $slug . ' Tidak ditemukan');
        }

        return view('books/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Buku',
            'validation' => \Config\Services::validation(),
        ];
        return view('books/tambah', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bookModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/books');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Buku',
            'book' => $this->bookModel->find($id),
            'validation' => \Config\Services::validation(),
        ];
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bookModel->update($id, [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil diupdate');
        return redirect()->to('/books');
    }

    public function delete($id)
    {
        $this->bookModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/books');
    }
}
