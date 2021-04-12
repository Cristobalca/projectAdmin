<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{


    //$id = id_project
    public function create($id)
    {
    
        Gate::authorize('haveaccess','task.create');

        $users = User::all();

        return view('tasks.create', compact('id', 'users'));
    }


    public function store(TaskRequest $request)
    {
        Gate::authorize('haveaccess','task.create');

        Task::create($request->all());
        return redirect()->route('projects.show', $request->get('project_id'))
        ->with('success', 'Tarea creada exitosamente');
    }


    public function show(Task $task , User $user)
    {

        $this->authorize('view',[$task,['checkedown.task','checkedasign.task']]);
        return view('tasks.show', compact('task','user'));
    }

    
    public function edit($id)
    {
        Gate::authorize('haveaccess','task.edit');

        $users = User::all();
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task', 'users'));
    }

    
    public function update(TaskRequest $request, Task $task)
    {
        // $this->authorize('update',$task);
         
        $task->update($request->all());

        return redirect()->route('projects.show', $request->get('project_id'))
            ->with('success', 'Tarea Actualizada exitosamente');
    }

    
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Tarea Borrada exitosamente');
    }
}
