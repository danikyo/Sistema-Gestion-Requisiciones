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
        	'caname' => 'Los chidos',
        	'clave'  => '1090', 
        	'name' => 'PC',
        	'startDate' => "2017-12-01",
        	'endDate' => "2018-12-01", 
        	'description' => 'Las descripciones pueden no tener sentido', 
            'Amount' => '150',
        	'currentAmount' => '150'
        ]);

        Activity::create([
        	'id' => 1,
        	'description' => 'actividad uno',
        	'project_id' => 100
        ]);

        Activity::create([
        	'id' => 50,
        	'description' => 'actividad dos',
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
        	'type' => 'HP',
        	'activity_id' => 50
        ]);

        Product::create([
        	'name' => 'Pantallas',
        	'price' => 100,
        	'resource_id' => 2
        ]);

        Product::create([
        	'name' => 'Teclado',
        	'price' => 50,
        	'resource_id' => 2
        ]);

        Activity::find(1)->users()->attach(2);
    }
}
