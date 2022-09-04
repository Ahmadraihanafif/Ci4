<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

use CodeIgniter\Database\Seeder;

class OrangSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'nama' => 'Sultan Ragib',
        //         'alamat'    => 'Cilegon Kota',
        //         'created_at' => time::now(),
        //         'updated_at' => time::now()
        //     ],
        //     [
        //         'nama' => 'Afif Ahmad',
        //         'alamat'    => 'Depok Kota',
        //         'created_at' => time::now(),
        //         'updated_at' => time::now()
        //     ],
        //     [
        //         'nama' => 'Aguss',
        //         'alamat'    => 'Jakarta Kota',
        //         'created_at' => time::now(),
        //         'updated_at' => time::now()
        //     ]
        // ];

        // Simple Queries
        // $this->db->query('INSERT INTO orang (nama, alamat) VALUES(:nama:, :alamat:)', $data);

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'nama' => $faker->name,
                'alamat'    => $faker->address,
                'created_at' => time::createFromTimestamp($faker->unixTime()),
                'updated_at' => time::now()
            ];
            $this->db->table('orang')->insert($data);
        }

        //ini untuk 1 data saja 
        //kalau ini banyak data 
        // $this->db->table('orang')->insertBatch($data);
    }
}
