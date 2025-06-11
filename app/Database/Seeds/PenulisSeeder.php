<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder

{
    public function run()
    {
        // $data = [

        //'name' => 'Nur Kholivah',
        //'address' => 'Kediri',
        //'created_at' => Time::now(),
        //'updated_at' => Time::now()
        //];
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name' => $faker->name,
                'address' => $faker->address,
                'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'email' => $faker->unique()->safeEmail,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];
            $this->db->table('penulis')->insert($data);
        }

        //$this->db->query('INSERT INTO penulis (name, address, created_at, updated_at) VALUES (:name:, :address:, :created_at:, :updated_at:)', $data);
        // $this->db->table('penulis')->insertBatch($data);
    }
}
