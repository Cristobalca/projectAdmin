@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Nuevo Proyectos</h1>
@stop

@section('content')
    <div class="container-fluid col-md-8">
        <div class="pull-right mb-2">
            <a class="btn btn-primary" href="{{ route('projects.index') }}" title="Volver atras">
                <i class="fas fa-backward "></i> </a>
        </div>
        <div class="card">
            <div class="card-header bg-dark">
                <h2>Crear Proyecto</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <strong>Whoops Falta algo!</strong><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Descripcion:</strong>
                                <textarea class="form-control" rows="3" name="description"
                                    placeholder="Descripcion"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>status:</strong>
                                <input type="text" name="status" class="form-control" placeholder="status">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="user_id">Lista usuario Asignar A:</label>
                                <select name="user_assigned_id" class="form-control">
                                    <option value="">General</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection
