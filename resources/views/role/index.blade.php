@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Lista de Roles</h1>
@stop

@section('content')
    <div class="container-fluid col-md-10">

        <div class="card">
            <div class="d-flex justify-content-start mt-2 ml-2">
                @can('haveaccess', 'role.create')
                    <a href="{{ route('role.create') }}" class="btn btn-primary ">Create
                    </a>
                @endcan
            </div>
            <div class="card-body">
                @include('custom.message')

                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Description</th>
                            <th scope="col">Full access</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role['full-access'] }}</td>
                                <td>
                                    @can('haveaccess', 'role.show')
                                        <a class="btn btn-info" href="{{ route('role.show', $role->id) }}">Show</a>
                                    @endcan
                                </td>
                                <td>
                                    @can('haveaccess', 'role.edit')
                                        <a class="btn btn-success" href="{{ route('role.edit', $role->id) }}">Edit</a>
                                    @endcan
                                </td>

                                <td>
                                    @can('haveaccess', 'role.destroy')
                                        <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    @endcan

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $roles->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection