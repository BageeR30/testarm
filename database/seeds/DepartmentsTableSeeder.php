<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name' => 'Первый',
        ]);

        DB::table('departments')->insert([
            'name' => 'Второй',
        ]);

        DB::table('departments')->insert([
            'name' => 'Третий',
        ]);
    }
}
