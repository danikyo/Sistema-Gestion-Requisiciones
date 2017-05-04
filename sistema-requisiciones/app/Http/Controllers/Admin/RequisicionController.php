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
use Response;
use Illuminate\Support\Facades\Input;

class RequisicionController extends Controller
{
    public function index()
    {
    	$projects = Project::all();
        $activityuser = User::find(auth()->user()->id)->activities()->get();

    	return view('requisicion.index')->with(compact('activityuser', 'projects'));
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

    public function getDownload(Request $request)
    {
        $filename = $request->input('filename');
        $file= public_path()."/facturas/".$filename;

        $headers = array(
          'Content-Type: application/pdf',
        );

        return Response::download($file, 'Act 13.pdf', $headers);
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
        //verificar Monto disponible
        $Proy = Project::find($request->input('proyecto'));
        $Req = Requisicion::where('project_id', $Proy->id);
        $total = 0;

        foreach($Req->get() as $req)
        {
            $Pro = $req->products()->get();
            foreach($Pro as $pro)
            {
                if ($pro->exercised == 1)
                    $total += $pro->price;
            }
        }

        foreach($request->input('idProducto') as $producto)
        {
            $product = Product::find($producto);
            $total += $product->price;
        }


        if ($Proy->currentAmount < $total)
        {
            return back()->with('error', 'No hay fondos disponibles');
        }
        else
        {
            //Enviar Solicitud
            $flag = false;
            $activityuser = User::find(auth()->user()->id)->activities()->get();
            foreach($activityuser as $activity)
            {
                if($activity->id == $request->input('actividad'))
                    $flag = true;
            }

            if($flag == true)
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
                    $product = Product::find($producto);
                    $product->exercised = 1;
                    $product->save();
                    $requisicionLast = Requisicion::all()->last()->id;
                    Requisicion::find($requisicionLast)->products()->attach($product);
                }

                return back()->with('notification', 'Solicitud Enviada');
            }
            else
            {
                return back()->with('error', 'Error, no tienes permiso para la actividad seleccionada');
            }
        }    
    }

    public function update()
    {
        $file = Input::file('factura');
        $file->move('facturas', $file->getClientOriginalName());
    }

    public function auth(Request $request, $id)
    {
        $requisicion = Requisicion::find($id);
        $project = Project::find($requisicion->project_id);
        $total = 0;

        if($request->status == 2)
        {
            $filename = $request->input('filename');
            $file= public_path()."/facturas/".$filename;

            $headers = array(
              'Content-Type: application/pdf',
            );

            return Response::download($file, $filename, $headers);
        }
        else
        {
            if(auth()->user()->is_compras)
            {
                if($request->input('autorizar') == 1)
                {
                    $products = $requisicion->products()->get();

                    foreach($products as $product)
                    {
                        $product->exercised = 2;
                        $product->save();

                        $total += $product->price;
                    }

                    $file = Input::file('factura');
                    $file->move('facturas', $file->getClientOriginalName());
                    $filename = $file->getClientOriginalName();

                    $requisicion->factura = $filename;
                    $requisicion->status = 2;
                    $requisicion->save();
                    $project->currentAmount = $project->currentAmount - $total;
                    $project->save();

                    return back()->with('notification', 'Requisicion Ejercida');
                }
                else
                {
                    $requisicion->status = 0;
                    $requisicion->save();

                    $Products = $requisicion->products()->get();
                    foreach($Products as $product)
                    {
                        $product->exercised = 0;
                        $product->save();
                    }

                    return back()->with('notification', 'Requisición Cancelada Correctamente');
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
                        $Products = $requisicion->products()->get();
                        foreach($Products as $product)
                        {
                            $product->exercised = 0;
                            $product->save();
                        }
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
                        $Products = $requisicion->products()->get();
                        foreach($Products as $product)
                        {
                            $product->exercised = 0;
                            $product->save();
                        }
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
                        $Products = $requisicion->products()->get();
                        foreach($Products as $product)
                        {
                            $product->exercised = 0;
                            $product->save();
                        }
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
        
    }

    public function byProject($id, $user)
    {
        //return User::find($user)->activities()->get()->where('project_id', $id);
    	return Activity::where('project_id', $id)->get();
    }

    public function byActivity($id)
    {
    	return Resource::where('activity_id', $id)->get();
    }

    public function byResource($id)
    {
    	return Product::where('resource_id', $id)->where('exercised', 0)->get();
    }

    public function byProduct($id)
    {
        return Product::where('id', $id)->get();
    }
}
