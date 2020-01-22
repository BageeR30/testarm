<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'name' => 'Директор',
        ]);

        DB::table('positions')->insert([
            'name' => 'Руководитель проекта',
        ]);

        DB::table('positions')->insert([
            'name' => 'Разработчик',
        ]);

        DB::table('positions')->insert([
            'name' => 'Дизайнер',
        ]);
    }
}
