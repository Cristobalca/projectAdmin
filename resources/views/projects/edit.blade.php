@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Editar Projecto</h1>
@stop

@section('content')
    <div class="container-fluid col-md-8">
        <div class="pull-right">
            <a class="btn btn-primary mb-2" href="{{ route('projects.index') }}" title="Go back"> <i
                    class="fas fa-backward "></i> </a>
        </div>

        <div class="card">
            <div class="card-header bg-dark">
                <h2>Editar Proyecto</h2>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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
                                <strong>Estado:</strong>
                                <input type="text" name="status" class="form-control" placeholder="{{ $project->status }}"
                                    value="{{ $project->status }}">
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
