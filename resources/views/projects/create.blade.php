@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Nuevo Proyectos</h1>
@stop
{{-- lista --}}
@section('content')
    <div class="container-fluid col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <h2>Crear Proyecto</h2>
            </div>
            <div class="card-body">
                @include('custom.message')

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
                                <label for="user_id">Estado del Proyecto</label>
                                <select name="status" class="form-control">
                                    <option value="1">Comenzado</option>
                                    <option value="2">En Proceso ...</option>
                                    <option value="3">Terminado</option>
                                </select>

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
                            <a class="btn btn-danger" href="{{ route('projects.index') }}" title="Volver atras">
                                Volver</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
