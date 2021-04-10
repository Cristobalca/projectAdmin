<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }


    //$id = id_project
    public function create($id)
    {
        $users = User::all();

        return view('tasks.create', compact('id', 'users'));
    }


    public function store(TaskRequest $request)
    {
        Task::create($request->all());
        return redirect()->route('projects.show', $request->get('project_id'))->with('success', 'Tarea creada');
    }


    public function show(Task $task , User $user)
    {

        return view('tasks.show', compact('task','user'));
    }

    
    public function edit($id)
    {
        $users = User::all();
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task', 'users'));
    }

    
    public function update(TaskRequest $request, Task $task)
    {
             
        $task->update($request->all());

        return redirect()->route('projects.show', $request->get('project_id'))
            ->with('success', 'Tarea Editada!');
    }

    
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Tarea Borrada!');
    }
}
