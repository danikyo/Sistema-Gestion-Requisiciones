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

    public function edit($id)
    {
        $project = Project::find($id);
        $activities = $project->activities()->get();
        return view('project.edit')->with(compact('project', 'activities'));
    }

    public function store(Request $request)
    {
        $rules = [
            'idca' => 'unique:projects,id',
        ];

        foreach($request->get('idActivity') as $key => $val)
        {
            $rules['idActivity.'.$key] = 'unique:activities,id';
        }

        foreach($request->get('resource-ID') as $key => $val)
        {
            $rules['resource-ID'.$key] = 'unique:resources,id';
        }

        $this->validate($request, $rules);

    	$project = new Project();
    	$project->id = $request->input('idca');
    	$project->caname = $request->input('nameca');
    	$project->clave = $request->input('clave');
    	$project->name = $request->input('name');
    	$project->startDate = $request->input('date1');
    	$project->endDate = $request->input('date2');
    	$project->description = $request->input('description');

        $total = 0;
        $i = 0;
        foreach($request->input('product-IDresource') as $p)
        {
            $total += $request->input('productPrice')[$i];
            $i++;
        }
    	$project->currentAmount = $total;
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