@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">{{ $project->name }}</h1>
@stop

@section('content')
    <div class="container-fluid col-md-10">

        <div class="row mb-2">
            <div>
                <a class="btn btn-primary mr-2 ml-2" href="{{ route('projects.index') }}" title="Volver">
                    <i class="fas fa-backward "></i></a>
            </div>
            <div>
                <a class="btn btn-success" href="{{ route('tasks.create', $project->id) }}" title="Crear tarea">
                    <i class="fas fa-plus-square "></i> Crear Tarea</a>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card mt-2 ">
            <div class="card-body">

                <small><strong>Descripcion :</strong></small>
                <Small> {{ $project->description }}</Small>
                <small><strong>| Estado: </strong></small>{{ $project->status }}<br>
                <small><strong>fecha creacion:</strong></small>
                <small>{{ date_format($project->created_at, 'jS M Y') }}</small><br>
                <small><strong>Asignado A: </strong></small>{{ $users[0]->name }}
            </div>
        </div>
        <div class="row row-cols-md-2">
            @foreach ($tasks as $task)
                <div class="col mb-2">

                    <div class="card text-white bg-dark mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><strong>Nombre: </strong>{{ $task->NombreTarea }}</h5>
                            <p class="card-text text-nowrap text-truncate">{{ $task->description }}</p>
                            <small class="card-text"><strong>Creada Por: </strong>{{ $task->Creador }}</small><br>
                            <small class="card-text"><strong>Asignado A: </strong>{{ $task->Asigando }}</small>
                        </div>
                        <div class="card-footer bg-dark">
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">

                                {{-- <a href="{{ route('tasks.show', $task->id) }}" title="show">
                                    <i class="fas fa-eye text-success  fa-lg"></i>
                                </a> --}}

                                <a href="{{ route('tasks.edit', $task->id) }}">
                                    <i class="fas fa-edit  fa-lg"></i>
                                </a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" title="delete" style="border: none; background-color:transparent;"
                                onclick="return confirm(&quot;Seguro que quiere Borrar La Tarea? delete?&quot;)">
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
