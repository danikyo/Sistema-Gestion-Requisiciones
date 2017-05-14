<?php

use Illuminate\Database\Seeder;
use App\Project;
use App\Activity;
use App\Resource;
use App\Product;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
        	'id' => 100,
            'idca'  => 'AG500',
        	'caname' => 'Desarrolladores informáticos', 
        	'name' => 'Aparatos Electrónicos',
        	'startDate' => "2017-12-01",
        	'endDate' => "2018-12-01", 
        	'description' => 'Las descripciones pueden no tener sentido, pero igual dejo una descripción', 
            'Amount' => '200',
        	'currentAmount' => '100'
        ]);

        Activity::create([
        	'id' => 1,
        	'description' => 'Construir Computadaoras',
        	'project_id' => 100
        ]);

        Activity::create([
        	'id' => 50,
        	'description' => 'Construir Móbiles',
        	'project_id' => 100
        ]);

        Resource::create([
        	'id' => 2,
        	'type' => 'Dell',
        	'activity_id' => 1
        ]);

        Resource::create([
        	'id' => 3,
        	'type' => 'Toshiba',
        	'activity_id' => 1
        ]);

        Resource::create([
        	'id' => 10,
        	'type' => 'Samsung',
        	'activity_id' => 50
        ]);

        Product::create([
        	'name' => 'Pantallas',
        	'price' => 100,
        	'resource_id' => 2,
        ]);

        Product::create([
        	'name' => 'Teclado',
        	'price' => 50,
        	'resource_id' => 2
        ]);

        Product::create([
            'name' => 'Teclado',
            'price' => 50,
            'resource_id' => 3
        ]);

        Product::create([
            'name' => 'Celular',
            'price' => 50,
            'resource_id' => 10
        ]);

        Activity::find(1)->users()->attach(5);
    }
}
