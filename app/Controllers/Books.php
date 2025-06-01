<?php

namespace App\Controllers;

use App\Models\BookModel;

helper('url');

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
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku ' . $slug . ' tidak ditemukan');
        }

        return view('books/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Buku',
            'validation' => \Config\Services::validation(),
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
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'File yang dipilih bukan gambar',
                    'mime_in' => 'Format gambar tidak didukung',
                ]
            ]
        ])) {
            return redirect()->to('/books/tambah')->withInput()->with('validation', \Config\Services::validation());
        }

        $fileSampul = $this->request->getFile('sampul');
        $namaFile = ($fileSampul->getError() == 4) ? 'default.jpg' : $fileSampul->getRandomName();

        if ($fileSampul->getError() != 4) {
            $fileSampul->move('img/sampul', $namaFile);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bookModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaFile,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/books');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data Buku',
            'validation' => \Config\Services::validation(),
            'book' => $this->bookModel->getBook($slug)
        ];
        return view('books/edit', $data);
    }

    public function update($id)
    {
        $bukulama = $this->bookModel->getBook($this->request->getVar('slug'));
        $rule_judul = ($bukulama['judul'] == $this->request->getVar('judul')) ? 'required' : 'required|is_unique[books.judul]';

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah dimasukkan'
                ]
            ]
        ])) {
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', \Config\Services::validation());
        }

        $fileSampul = $this->request->getFile('sampul');
        $namaFile = $this->request->getVar('sampulLama');

        if ($fileSampul->getError() != 4) {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('img/sampul', $namaFile);
            if ($this->request->getVar('sampulLama') != 'default.jpg') {
                unlink('img/sampul/' . $this->request->getVar('sampulLama'));
            }
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bookModel->update($id, [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaFile,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/books');
    }

    public function delete($id)
    {
        $book = $this->bookModel->find($id);
        if ($book['sampul'] != 'default.jpg') {
            unlink('img/sampul/' . $book['sampul']);
        }

        $this->bookModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/books');
    }

       public function beranda()
    {
        $data = ['title' => 'Beranda'];
        return view('books/beranda', $data);
    }

    public function tentang()
    {
        $data = ['title' => 'Tentang Kami'];
        return view('books/tentang', $data);
    }

    public function hubungi()
    {
        $data = ['title' => 'Hubungi Kami'];
        return view('books/hubungi', $data);
    }
}
