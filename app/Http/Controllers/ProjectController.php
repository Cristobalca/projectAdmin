<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(5);

        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // buscar ejemplo
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        return view('projects.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'user_assigned_id' => 'required',

        ]);


        Project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.'); // resivar ejemplo de platziPress
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $tasks)
    {
        // $tasks = Task::where('project_id', $project->id)->get();
        // $tasks = DB::table('tasks')->where('project_id', $project->id)->get();
            //revisar consulta 
        $tasks = DB::table('tasks AS ts')
            ->join('users AS a', 'a.id', 'ts.user_created_id')
            ->join('users AS b',  'b.id', 'ts.user_assigned_id')
            ->select(
                'ts.id',
                'ts.project_id',
                'ts.name as NombreTarea',
                'a.name as Creador',
                'b.name as Asigando',
                'ts.description'
            )
            ->where('ts.project_id', $project->id)
            ->get();

        $users = User::where('id', $project->user_assigned_id)
            ->select('name')
            ->get();

        // return dd($users[0]->name);
        // dd(compact('user','project'));

        return view('projects.show', compact('project', 'tasks', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('danger', 'Project deleted successfully');
    }
}
