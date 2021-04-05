{{-- @extends('layouts.app')

@section('content') --}}
@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Proyectos</h1>
@stop

@section('content')
    <div class="container-fluid col-md-10">
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


        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Fecha Creacion</th>
                <th>Action</th>
            </tr>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST">

                            <a href="{{ route('projects.show', $project->id) }}" title="show">
                                <i class="fas fa-eye text-success  fa-lg"></i>
                            </a>

                            <a href="{{ route('projects.edit', $project->id) }}">
                                <i class="fas fa-edit  fa-lg"></i>
                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>

                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="row">

            {!! $projects->links() !!}
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
