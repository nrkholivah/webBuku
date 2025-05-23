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
            'validation' => \Config\Services::validation(),
        ];
        return view('books/tambah', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul]',
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
            $validation = \config\Services::validation();
            return redirect()->to(base_url() . '/books/tambah')->withInput()->with('validation', $validation);
        }

        // handle file upload
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaFile = 'default.jpg'; // file default kalau user nggak upload apa-apa
        } else {
            $namaFile = $fileSampul->getRandomName();
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
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah dimasukkan'
                ]
            ]
        ])) {
            $validation = \config\Services::validation();
            return redirect()->to('/books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        // ambil file
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaFile = $this->request->getVar('sampulLama');
        } else {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('img/sampul', $namaFile);
            // hapus file lama
            if ($this->request->getVar('sampulLama') != 'default.jpg') {
                unlink('img/sampul/' . $this->request->getVar('sampulLama'));
            }
        }


        session()->setFlashdata('pesan', 'Data berhasil diubah');
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
