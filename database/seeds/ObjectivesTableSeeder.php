<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ObjectivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('objectives')->insert([
            'label' => 'root',
            'goal' => 0,
            'deadline' => 0,
            'parent_objective_id' => 1,
            'created_at' => $date->getTimestamp(),
            'updated_at' => $date->getTimestamp()
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
