<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ContractTemplateSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    	$this->call(ToursTableSeeder::class);
    	// $this->call(TouristsTableSeeder::class);
        // $this->call(DocumentsSeeder::class);
        // $this->call(Tour2sTouristsTableSeeder::class);
        $this->call(ContractTemplateDraftsSeeder::class);
        $this->call(BranchesTableSeeder::class);


    }
}
