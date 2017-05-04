<?php

namespace App\Http\Controllers\Admin;
use App\Project;
use App\Activity;
use App\Resource;
use App\User;
use App\Product;

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

    public function read(Request $request)
    {
        if($request->get('name') != '')
        {
            $projects = Project::search($request->get('name'))->paginate('10');
        }
        else
        {
            $projects = Project::paginate('10');
        }

        return view('project.read')->with(compact('projects',$projects));
    }

    public function review(Request $request)
    {
        $activityuser = User::find(auth()->user()->id)->activities()->paginate('10'); //busca actividades del usuario que esta logeado

        $projects = Project::all();

        return view('project.read2')->with(compact('projects', 'activityuser'));
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $activities = $project->activities()->get();
        return view('project.edit')->with(compact('project', 'activities'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $current = $project->currentAmount;

        $project->currentAmount = $request->input('currentAmount') + $current;
        $project->endDate = $request->input('date');

        $project->save();

        return back()->with('notification', 'Proyecto Actualizado Satisfactoriamente!');
    }

    public function store(Request $request)
    {
        $rules = [
            'idca' => 'unique:projects,id',
        ];

        $messages = [
            'idca.unique' => 'El ID elegido para el proyecto está en uso, intenta con otro distinto',
        ];


        foreach($request->get('idActivity') as $key => $val) //obtiene cada elemento de la tabla para evitar que se repitan datos registrados
        {
            $rules['idActivity.'.$key] = 'unique:activities,id';
        }

        foreach($request->get('resource-ID') as $key => $val)
        {
            $rules['resource-ID.'.$key] = 'unique:resources,id';
        }

        $i = 0;
        foreach($request->input('idActivity') as $key) //escribe mensajes para cada elemento de tabla que se repita
        {
            $messages['idActivity.'.$i.'.unique'] = 'El ID '.$key.' en actividades ya está en uso, intenta con otro distinto';
            $i++;
        }

        $i = 0;
        foreach($request->input('resource-ID') as $key)
        {
            $messages['resource-ID.'.$i.'.unique'] = 'El ID '.$key.' en recursos ya está en uso, intenta con otro distinto';
            $i++;
        }

        $this->validate($request, $rules, $messages);

    	$project = new Project();
        $project->startDate = $request->input('date1');
        $project->endDate = $request->input('date2');
    	$project->id = $request->input('idca');
    	$project->clave = $request->input('clave');
        $project->caname = $request->input('nameca');
    	$project->name = $request->input('name');
        $project->currentAmount = $request->input('currentAmount');
    	$project->description = $request->input('description');

        $total = 0;
        $i = 0;
        foreach($request->input('product-IDresource') as $p)
        {
            $total += $request->input('productPrice')[$i];
            $i++;
        }
        $project->Amount = $total;
    	$project->save();

        $i = 0;
        foreach($request->input('activityDescription') as $d)
        {
            $activity = new Activity();
            $activity->id = $request->input('idActivity')[$i];
            $activity->description = $d;

            $projectA = Project::find($project->id);
            $projectA->activities()->save($activity);
            $i++;
        }

        $i = 0;
        foreach($request->input('resource-IDactivity') as $r)
        {
            $resource = new Resource();
            $resource->id = $request->input('resource-ID')[$i];
            $resource->type = $request->input('resourceType')[$i];

            $activity = Activity::find($request->input('resource-IDactivity')[$i]);
            $activity->resources()->save($resource);

            $i++;
        }

        $i = 0;
        foreach($request->input('product-IDresource') as $p)
        {
            $product = new Product();
            $product->name = $request->input('productName')[$i];
            $product->price = $request->input('productPrice')[$i];

            $resource = Resource::find($request->input('product-IDresource')[$i]);
            $resource->products()->save($product);

            $i++;
        }

        $i = 0;
        foreach($request->input('id-user') as $ua)
        {
            $user = User::find($ua);
            $activityFind = $request->input('user-IDactivity')[$i];
            Activity::find($activityFind)->users()->attach($user);

            $i++;
        }
        
    	return back()->with('notification', 'Proyecto Registrado Satisfactoriamente!');
    }

    public function byUser($data)
    {
        return User::where('id', $data)->get();
    }
}