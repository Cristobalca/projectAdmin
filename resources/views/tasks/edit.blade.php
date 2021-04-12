@extends('adminlte::page')

@section('title', 'Editar Tarea')
@section('content_header')
    <h1 class="d-flex justify-content-center">Editar Tarea</h1>
@stop

@section('content')
    <div class="container-fluid col-md-10">
        <div class="card">
            <div class="card-header bg-dark">
                <h2>Editar Tarea</h2>
            </div>
            <div class="card-body">
                @include('custom.message')
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Nombre"
                                value="{{ $task->name }}">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            <textarea class="form-control" rows="3" name="description"
                                placeholder="Descripcion">{{ $task->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="project_id" class="form-control readOnly"
                            value=" {{ $task->project_id }}">
                        <input type="hidden" name="user_created_id" class="form-control readOnly"
                            value=" {{$task->user_created_id }}">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label for="user_id">Asignar A:</label>
                            <select name="user_assigned_id" class="form-control">
                                <option value="{{ $task->user_assigned_id }}">Desea cambiar el Usuario Asignado?</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Editar Tarea</button>
                            <a class="btn btn-danger" href="{{ route('projects.show', $task->project_id) }}">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
