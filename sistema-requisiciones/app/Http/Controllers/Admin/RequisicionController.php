<?php

namespace App\Http\Controllers\Admin;

use App\Requisicion;
use App\Project;
use App\Activity;
use App\Resource;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequisicionController extends Controller
{
    public function index()
    {
    	$projects = Project::all();
    	return view('requisicion.index')->with(compact('projects'));
    }

    public function read(Request $request)
    {
        if($request->get('name') != '')
        {
            $requisicions = User::find(auth()->user()->id)->requisicions()->search($request->get('name'))->paginate('10');
        }
        else
        {
            $requisicions = User::find(auth()->user()->id)->requisicions()->paginate('10');
        }

        return view('requisicion.read')->with(compact('requisicions'));
    }

    public function all(Request $request)
    {
        $user = User::all();

        if($request->get('name') != '')
        {
            $requisicions = Requisicion::search($request->get('name'))->paginate('10');
        }
        else
        {
            $requisicions = Requisicion::paginate('10');
        }

        return view('requisicion.all')->with(compact('requisicions', 'user'));
    }

    public function view($id)
    {
        $requisicion = Requisicion::find($id);
        $user = User::find($requisicion->user_id);
        $project = Project::find($requisicion->project_id);
        $activity = Activity::find($requisicion->activity_id);
        $resource = Resource::find($requisicion->resource_id);

        $autorizado;
        if($requisicion->secretario == 0 && $requisicion->planeacion == 0 && $requisicion->finanzas == 0)
        {
            $autorizado = "No";
        }
        else
        {
            $autorizado = "Si";
        }

        $status;
        if($requisicion->status == 0)
        {
            $status = "Cancelado";
        }
        else if($requisicion->status == 1)
        {
            $status = "Pendiente por ejercer";
        }
        else if($requisicion->status == 2)
        {
            $status = "Ejercido";
        }

        $total = 0;
        $iva;

        return view('requisicion.view')->with(compact('requisicion', 'user', 'project', 'activity', 'resource', 'autorizado', 'status', 'total', 'iva'));
    }

    public function store(Request $request)
    {
        $requisicion = new Requisicion();

        $requisicion->date = $request->input('fecha');
        $requisicion->area = $request->input('area');
        $requisicion->observations = $request->input('observaciones');

        $requisicion->user_id = auth()->user()->id;
        $requisicion->project_id = $request->input('proyecto');
        $requisicion->activity_id = $request->input('actividad');
        $requisicion->resource_id = $request->input('recurso'); 

        $requisicion->save();

        foreach($request->input('idProducto') as $producto)
        {
            $producto = Product::find($producto);
            $requisicionLast = Requisicion::all()->last()->id;
            Requisicion::find($requisicionLast)->products()->attach($producto);
        }

        return back()->with('notification', 'Solicitud Enviada');
    }

    public function auth(Request $request, $id)
    {
        $requisicion = Requisicion::find($id);
        $project = Project::find($requisicion->project_id);
        $total = 0;

        if(auth()->user()->is_compras)
        {
            if($request->input('autorizar') == 1)
            {
                $products = $requisicion->products()->get();
                $usada = false;

                foreach($products as $product)
                {
                    if($product->exercised == 1)
                        $usada = true;
                }

                if ($usada == false)
                {
                    foreach($products as $product)
                    {
                        $product->exercised = 1;
                        $total += $product->price;
                        $product->save();
                    }

                    $requisicion->status = 2;
                    $requisicion->save();
                    $project->currentAmount = $project->currentAmount - $total;
                    $project->save();

                    return back()->with('notification', 'Requisicion Ejercida');
                }

                return back()->with('error', 'Imposible Ejercer por falta de productos');
            }
            else
            {
                $requisicion->status = 0;
                $requisicion->save();

                return back()->with('notification', 'Requisición Cancelada');
            }
        }
        else
        {
            if(auth()->user()->role == 1) //secretario academico
            {
                if($request->input('autorizar') == 1)
                {
                    $requisicion->secretario = 1;
                    $requisicion->save();
                }
                else
                {
                    $requisicion->status = 0;
                    $requisicion->save();
                }
            }
            else if(auth()->user()->role == 2) //planeacion
            {
                if($request->input('autorizar') == 1)
                {
                    $requisicion->planeacion = 1;
                    $requisicion->save();
                }
                else
                {
                    $requisicion->status = 0;
                    $requisicion->save();
                }
            }
            else if(auth()->user()->role == 3) //finanzas
            {
                if($request->input('autorizar') == 1)
                {
                    $requisicion->finanzas = 1;
                    $requisicion->save();
                }
                else
                {
                    $requisicion->status = 0;
                    $requisicion->save();
                }
            }

            if($request->input('autorizar') == 1)
            {
                return back()->with('notification', 'Requisicion Autorizada');
            }
            else
            {
                return back()->with('notification', 'Requisicion Cancelada');
            }
        }   
    }

    public function byProject($id)
    {
    	return Activity::where('project_id', $id)->get();
    }

    public function byActivity($id)
    {
    	return Resource::where('activity_id', $id)->get();
    }

    public function byResource($id)
    {
    	return Product::where('resource_id', $id && 'exercised', 0)->get();
    }

    public function byProduct($id)
    {
        return Product::where('id', $id)->get();
    }
}
