@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Editar Proyecto</h1>
@stop
{{-- lista --}}
@section('content')
    <div class="container-fluid col-md-8">
        <div class="card">
            <div class="card-header bg-dark">
                <h2>Editar Proyecto</h2>
            </div>
            <div class="card-body">
                @include('custom.message')

                <form action="{{ route('projects.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nombre:</strong>
                                <input type="text" name="name" value="{{ $project->name }}" class="form-control"
                                    placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Descripcion:</strong>
                                <textarea class="form-control" style="height:50px" name="description"
                                    placeholder="Descripcion">{{ $project->description }}</textarea>
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
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <a class="btn btn-danger" href="{{ route('projects.index') }}" title="Volver">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
