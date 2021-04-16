<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class ProjectController extends Controller
{
    
    public function index(Request $request )
    {
        Gate::authorize('haveaccess','project.index');

        $name = $request->get('name');
        $date = $request->get('date');
        $status = $request->get('status');


        $projects = Project::latest()
            ->name($name)
            ->date($date)
            ->status($status)
            ->paginate(5);


        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // buscar ejemplo
    }


    public function create()
    {
        
        Gate::authorize('haveaccess','project.create');

        $users = User::all();

        return view('projects.create', compact('users'));
    }
    
    public function store(ProjectRequest $request)
    {
        Gate::authorize('haveaccess','project.create');
        Project::create($request->all());
        return redirect()->route('projects.index')
            ->with('success', 'Proyecto Creado exitosamente'); // resivar ejemplo de platziPress
    }

    
    public function show(Project $project, Task $tasks)
    {
        Gate::authorize('haveaccess','project.show');

      
            //revisar consulta para optimizar
        $tasks = DB::table('tasks AS ts')
            ->join('users AS a', 'a.id', 'ts.user_created_id')
            ->join('users AS b',  'b.id', 'ts.user_assigned_id')
            ->select(
                'ts.id',
                'ts.project_id',
                'ts.name as NombreTarea',
                'a.name as Creador',
                'b.name as Asigando',
                'ts.description',
                'ts.is_complete'
            )->orderBy('id','desc')
            ->where('ts.project_id', $project->id)
            ->get();
            if($tasks->get('is_complete')==1){
            }
            //total de tareas completadas de un projecto
            $TC = DB::table('tasks')->where('tasks.is_complete',1)
            ->Where('tasks.project_id', $project->id )->count();
            
        $users = User::where('id', $project->user_assigned_id)
            ->select('name')
            ->get();


        return view('projects.show', compact('project', 'tasks', 'users','TC'));
    }

    
    public function edit(Project $project)
    {
        Gate::authorize('haveaccess','project.edit');

        $users = User::all();
        return view('projects.edit', compact('project','users'));
    }
    
    public function update(ProjectRequest $request, Project $project)
    {
        Gate::authorize('haveaccess','project.edit');
        // dd($request->all());
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto Acutilizado exitosamente');
    }
  
    public function destroy(Project $project)
    {
        Gate::authorize('haveaccess','project.destroy');

        $project->delete();

        return redirect()->route('projects.index')
            ->with('danger', 'Proyecto Borrado exitosamente');
    }
}
