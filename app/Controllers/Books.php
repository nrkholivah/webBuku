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

        return view('books/detail', $data);
    }
}
