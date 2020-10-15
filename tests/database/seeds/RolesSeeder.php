<?php
namespace alessandrobelli\Lingua\Tests\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => config('lingua.admin-role'),
        ]);
        DB::table('roles')->insert([
            'name' => config('lingua.translator-role'),
        ]);
    }
}
