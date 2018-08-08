<?php

use Illuminate\Database\Seeder;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cats')->insert([
        	[
            	'id'=>1,
            	'name'=>'mèo mull',
            	'date_of_birth'=>'2007-06-12',
            	'breed_id'=>1,
            	'created_at'=>date('Y-m-d H:i:s'),
            	'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
            	'id'=>2,
            	'name'=>'mèo tam thể',
            	'date_of_birth'=>'2012-02-02',
            	'breed_id'=>2,
            	'created_at'=>date('Y-m-d H:i:s'),
            	'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id'=>3,
                'name'=>'mèo trắng',
                'date_of_birth'=>'2008-06-12',
                'breed_id'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
