<?php

namespace App\Http\Controllers\Admin;
use App\Project;
use App\Activity;
use App\Resource;
use App\User;
use App\Product;
//use App\ActivityUser;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        $activities = Activity::all()->last();
        $resources = Resource::all()->last();
        $users = User::all();
    	return view('project.index')->with(compact('activities', 'resources', 'users'));
    }

    public function read()
    {
        $projects = Project::all();
        return view('project.read')->with(compact('projects'));
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $activities = $project->activities()->get();
        return view('project.edit')->with(compact('project', 'activities'));
    }

    public function store(Request $request)
    {
        $rules = [
            'resource-IDactivity' => 'exists:activities,id',
            'product-IDresource' => 'exists:resources,id',
            'user-IDactivity' => 'exists:activities,id'
        ];

        $messages = [
            'resource-IDactivity.exists' => 'El ID de actividad escrito en recursos no existe en la base de datos',
            'product-IDresource.exists' => 'El ID de recurso escrito en productos no existe en la base de datos',
            'user-IDactivity.exists' => 'El ID de actividad escrito en usuarios no existe en la base de datos'
        ];

        //$this->validate($request, $rules, $messages);

    	$project = new Project();
    	$project->id = $request->input('idca');
    	$project->caname = $request->input('nameca');
    	$project->clave = $request->input('clave');
    	$project->name = $request->input('name');
    	$project->startDate = $request->input('date1');
    	$project->endDate = $request->input('date2');
    	$project->description = $request->input('description');
    	$project->currentAmount = $request->input('amount');
    	$project->save();


        foreach($request->input('activityDescription') as $d)
        {
            $activity = new Activity();
            $activity->description = $d;

            $projectA = Project::find($project->id);
            $projectA->activities()->save($activity);

        }

        $i = 0;
        foreach($request->input('id-user') as $ua)
        {
            $user = User::find($ua);
            $activityFind = $request->input('user-IDactivity')[$i];
            Activity::find($activityFind)->users()->attach($user);

            $i++;
        }

        $i = 0;
        foreach($request->input('resource-IDactivity') as $r)
        {
            $resource = new Resource();
            $resource->type = $request->input('resourceType')[$i];
            $resource->amount = $request->input('resourceAmount')[$i];

            $activity = Activity::find($request->input('resource-IDactivity')[$i]);
            $activity->resources()->save($resource);

            $i++;
        }

        $i = 0;
        foreach($request->input('product-IDresource') as $p)
        {
            $product = new Product();
            $product->name = $request->input('productName')[$i];
            $product->quantity = $request->input('productQuantity')[$i];
            $product->price = $request->input('productPrice')[$i];

            $resource = Resource::find($request->input('product-IDresource')[$i]);
            $resource->products()->save($product);

            $i++;
        }

    	return back()->with('notification', 'Proyecto Registrado Satisfactoriamente!');
    }

    public function byUser($dato)
    {
        return User::where('id', $dato)->get();
    }
}