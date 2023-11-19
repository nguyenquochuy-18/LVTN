<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Quần',
                'slug' => 'quan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Áo',
                'slug' => 'ao',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
