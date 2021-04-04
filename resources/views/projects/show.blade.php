@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $project->name }}</h2>
            </div>
        </div>
    </div>   
        <div class="row">
            <div class="mr-3">
                <a class="btn btn-primary" href="{{ route('projects.index') }}" title="Go back"> <i
                    class="fas fa-backward "></i> volver </a>
            </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('tasks.create', $project->id) }}" title="Crear tarea"> <i
                        class="fas fa-plus-square "></i> Crear Tarea</a>
                </div>
        </div>
            <div class="row">

              descripcion :{{ $project->description }}<br>
               status: {{ $project->status }}<br>
               fecha creacion: {{ date_format($project->created_at, 'jS M Y') }}<br>
               <strong>Asignado A:</strong>{{ $users[0]->name}}
               

              
     
                
            </div>
            <div class="row row-cols-4 row-cols-md-2">
            @foreach ($tasks as $task )
                <div class="col mb-2">

                    <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                        {{-- <div class="card-header bg-dark">{{ $task->name }}</div> --}}
                        <div class="card-body">
                        <h5 class="card-title"><strong>Nombre: </strong>{{ $task->NombreTarea }}</h5>
                        <p class="card-text">{{ $task->description }}</p>
                        <small class="card-text"><strong>Creada Por: </strong>{{ $task->Creador }}</small>
                        <small class="card-text"><strong>Asignado A: </strong>{{ $task->Asigando }}</small>
                        </div>
                        <div class="card-footer bg-dark">
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">

                                <a href="{{ route('tasks.show', $task->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a>
        
                                <a href="{{ route('tasks.edit', $project->id) }}">
                                    <i class="fas fa-edit  fa-lg"></i>
                                </a>
        
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                    <i class="fas fa-trash fa-lg text-danger"></i>
        
                                </button>
                            </form>    
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
      
</div>
@endsection
