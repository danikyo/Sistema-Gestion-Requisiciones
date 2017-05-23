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
        return view('project.read2')->with(compact('projects', 'activityuser'));
    }

    public function edit($id)
    {
        $project = Project::find($id);
        $activities = $project->activities()->get();
        $flag = 0; //no se puede modificar el proyecto si está en falso
        foreach($activities as $activity)
        {
            foreach($activity->resources()->get() as $resources)
            {
                foreach($resources->products()->get() as $product)
                {
                    if($product->exercised != 2)
                    {
                        $flag = 1; //si un producto no está ejercido, se podrá modificar el proyecto
                    }
                }
            }
        }
        return view('project.edit')->with(compact('project', 'activities', 'flag'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $current = $project->currentAmount;

        $project->currentAmount = $request->input('currentAmount') + $current;

        $project->plusAmount = $project->plusAmount + $request->input('currentAmount');

        $project->endDate = $request->input('date');

        if($project->plusAmount > $project->Amount || $request->input('currentAmount') < 0)
        {
            return back()->with('error', 'No puedes exceder el monto!');
        }
        else
        {
            $project->save();
            return back()->with('notification', 'Proyecto Actualizado Satisfactoriamente!');
        }
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

        if(repeatActivity($request) || repeatResource($request) || repeatUserActivity($request))
        {
            if(repeatActivity($request))
            {
                return back()->with('error', 'No puedes repetir el ID de las actividades en la lista');
            }
            else if(repeatResource($request))
            {
                return back()->with('error', 'No puedes repetir el ID de los recursos en la lista');
            }
            else
            {
                return back()->with('error', 'No puedes repetir usuarios en la misma actividad');
            }
        }
        else
        {
            $project = new Project();
            $project->startDate = $request->input('date1');
            $project->endDate = $request->input('date2');
            $project->id = $request->input('id');
            $project->idca = $request->input('idca');
            $project->caname = $request->input('nameca');
            $project->name = $request->input('name');
            //$project->currentAmount = $request->input('currentAmount');
            //$project->plusAmount = $request->input('currentAmount');
            $project->currentAmount = 0;
            $project->plusAmount = 0;
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
    }

    public function byUser($data)
    {
        return User::where('id', $data)->get();
    }
}

//función que sirve para identificar si se repite algún elemento de la lista
function repeatActivity($request)
{
    $double = false;
    $i = 0;
    foreach($request->input('idActivity') as $activity)
    {
        $a = 0;
        foreach($request->input('idActivity') as $activity2)
        {
            if ($i != $a)
            {
                if ($activity == $activity2)
                {
                    $double = true;
                }
            }
            
            $a++;                
        }
        $i++;
    }

    return $double;
}

//función que sirve para identificar si se repite algún elemento de la lista
function repeatResource($request)
{
    $double = false;
    $i = 0;
    foreach($request->input('resource-ID') as $activity)
    {
        $a = 0;
        foreach($request->input('resource-ID') as $activity2)
        {
            if ($i != $a)
            {
                if ($activity == $activity2)
                {
                    $double = true;
                }
            }
            
            $a++;                
        }
        $i++;
    }

    return $double;
}

//función que sirve para identificar si se repite algún elemento de la lista
function repeatUserActivity($request)
{
    $flag = false;
    $i = 0;
    foreach($request->input('id-user') as $idUser)
    {
        $id = $request->input('id-user');
        $activity = $request->input('user-IDactivity')[$i];
        $a = 0;

        foreach($request->input('id-user') as $idUser2)
        {
            $activity2 = $request->input('user-IDactivity')[$a];

            if ($i != $a)
            {
                if ($activity == $activity2 && $idUser == $idUser2)
                {
                    $flag = true;
                }
            }
            $a++;                
        }
        $i++;
    }

    return $flag;
}