<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for( $i = 1; $i <=20; ++$i) {
            DB::table('products')->insert([
                [
                    'name' => 'sản phẩm '. $i,
                    'price' => 1000 + $i,
                    'description' => 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged',
                    'thumbnail' => null,
                    'slug' => 'san-pham-'.$i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}
