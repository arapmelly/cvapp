<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('services')->delete();

        $services = array(
        	array('ref'=>'review', 'name'=>'CV Review', 'description' => 'Upload your current CV for a confidential in-depth review from one of our professional CV experts...', 'cost'=>100),
        	array('ref'=>'format', 'name'=>'CV Formatting', 'description' => 'Send us your CV and we will convert it into the required format using our professional templates...', 'cost'=>500),
        	array('ref'=>'write', 'name'=>'CV Re-writing', 'description' => 'Our experts will re-write your CV in a manner that will increase the number of interviews you are invited to...', 'cost'=>1000),
        );	

        DB::table('services')->insert($services);
    }
}
