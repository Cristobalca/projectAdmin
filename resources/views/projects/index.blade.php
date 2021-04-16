@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Proyectos</h1>
@stop

@section('content')
    <div class="container-fluid col-md-12">

        <div class="card">
            <div class="card-body">
                @can('haveaccess', 'project.create')

                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('projects.create') }}" title="Create a project">
                            <i class="fas fa-plus-circle"></i>
                            Crear Proyecto
                        </a>
                    </div>
                @endcan
               
                <form method="GET" action="{{ url('admin/projects') }}" accept-charset="UTF-8" class="form-inline col mb-2 justify-content-center"
                role="search">
                <div class="form-group mr-1">
                    <input type="text" class="form-control" name="name" placeholder="Buscar por Nombre..."
                        value="{{ request('name') }}">
                </div>
                <div class="form-group mr-1">
                    <input type="date" class="form-control" name="date" placeholder="fecha.."
                        value="{{ request('date') }}">
                </div>
                <div class="form-group mr-1">
                    <input type="text" class="form-control" name="status" placeholder="Buscar por Estado..."
                        value="{{ request('status') }}">
                </div>
                <span class="input-group-append">
                    <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                    </button>
                </span>
       
            </form>
                @include('custom.message')
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
                                    <td style="border-left: 0; border-right: 0;">
                                        <a href="{{ route('projects.show', $project->id) }}">
                                            <button class="btn btn-info btn-sm">
                                                <i class="fas fa-folder-open"></i>Abrir
                                            </button>
                                        </a>
                                    </td>
                                    <td style="border-left: 0; border-right: 0;">
                                        @can('haveaccess', 'project.edit')
                                            <a href="{{ route('projects.edit', $project->id) }}">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit  fa-md"></i>Editar
                                                </button>
                                            </a>
                                        @endcan
                                    </td>
                                    <td style="border-left: 0">
                                        @can('haveaccess', 'project.destroy')
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mr-1" title="delete"
                                                    onclick="return confirm(&quot;Seguro que quiere Borrar el Proyecto? delete?&quot;)">
                                                    <i class="fas fa-trash fa-mdd "></i>Eliminar
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
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
