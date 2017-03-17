<?php

namespace App\Http\Controllers\Admin;
use App\Project;
USE App\Activity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
    	return view('project.newProject');
    }

//15 . validar
    public function getProject()
    {
    	return view('project.newProject');
    }

    public function postProject(Request $request)
    {
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

        foreach($request->input('Adescription') as $d)
        {
            $activity = new Activity();
        $activity->description = $d;
        $activity->project_id = $request->input('idca');
        $activity->save();
        }

    	return back()->with('notification', 'Proyecto Registrado Satisfactoriamente!');
    }
}