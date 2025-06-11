<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailAndPhoneToPenulis extends Migration
{
    public function up()
    {
        $this->forge->addColumn('penulis', [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'name' // kolom setelah name
            ],
             'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null' => true,
                'after' => 'email' // kolom setelah email
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('penulis', ['email', 'gender']);
    }
}
