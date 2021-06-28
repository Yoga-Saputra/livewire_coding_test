<?php

use App\Rekening;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rekening::create([
            'name' => 'BCA 123456 dani',
        ]);
        Rekening::create([
            'name' => 'BNN 123456 reni',
        ]);
    }
}
