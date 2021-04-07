@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Proyectos</h1>
@stop

@section('content')
    <div class="container-fluid col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('projects.create') }}" title="Create a project">
                        <i class="fas fa-plus-circle"></i>
                        Crear Proyecto
                    </a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm ">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Fecha de Creacion</th>
                                <th colspan="3">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->status }}</td>
                                    <td>{{ $project->created_at->format('d M Y') }}</td>
                                    <td colspan="3">

                                        <a href="{{ route('projects.show', $project->id) }}">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fas fa-folder-open"></i>Abrir
                                            </button>
                                        </a>
                                        <a href="{{ route('projects.edit', $project->id) }}">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit  fa-md"></i>Editar
                                            </button>
                                        </a>
                                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mr-1" title="delete"
                                                onclick="return confirm(&quot;Seguro que quiere Borrar el Proyecto? delete?&quot;)">
                                                <i class="fas fa-trash fa-mdd "></i>Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">

                    {!! $projects->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script>
        console.log('Hi!');

    </script>
@stop
