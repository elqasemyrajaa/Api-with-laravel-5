<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource as ResourcesProjects;
use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(15);
        return ResourcesProjects::collection($projects);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = $request->isMethod('put') ? Project::findOrFail($request->projects_id) : new Project();
        $project->id = $request->input('projects_id');
        $project->name = $request->input('name');
        $project->description = $request->input('description');

        if ($project->save()) {
            return new ResourcesProjects($project);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return new ResourcesProjects($project);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->delete()) {
            return new ResourcesProjects($project);
        }
    }
}
