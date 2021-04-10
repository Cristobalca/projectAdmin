@extends('adminlte::page')

@section('title', 'Crear Tarea')
@section('content_header')
    <h1 class="d-flex justify-content-center">Crear Tarea</h1>
@stop

@section('content')
    <div class="container-fluid col-md-10">
        <div class="card">
            <div class="card-header bg-dark">
                <h2>Crear Tarea</h2>
            </div>
            <div class="card-body">  
                
            @include('custom.message')

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            <textarea class="form-control" style="height:50px" name="description"
                                placeholder="Descripcion"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="project_id" class="form-control readOnly" placeholder="Name Project "
                            value=" {{ $id }}">

                        <input type="hidden" name="user_created_id" class="form-control readOnly"
                            placeholder="Name Project " value=" {{ auth()->user()->id }}">
                    </div>

                    <div class="form-group">
                        <label for="user_id">Asignar A:</label>
                        <select name="user_assigned_id" class="form-control">
                            <option value="">Lista de usuarios</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <a class="btn btn-danger" href="{{ route('projects.show', $id) }}">Volver</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    @endsection
