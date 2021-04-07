@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1 class="d-flex justify-content-center">Lista de Usuarios</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
<div class="card-header d-flex justify-content-center">
              <form method="GET" action="{{ url('/user') }}" accept-charset="UTF-8" class="form-inline col-6" role="search">
                <div class="input-group col">
                    <input type="text" class="form-control" name="search" placeholder="Buscar..." value="{{ request('search') }}">
                    <span class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
          </div>
            
                <div class="card-body">
                    @include('custom.message')

                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role(s)</th>
                            <th colspan="3"></th>
                          </tr>
                        </thead>
                        <tbody>
                          
                            
                            @foreach ($users as $user)
                            
                            <tr>
                                <th scope="row">{{ $user->id}}</th>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                @isset( $user->roles[0]->name )
                                  {{ $user->roles[0]->name}}
                                @endisset
                                
                                </td>
                                <td> 
                                @can('view',[$user, ['user.show','userown.show'] ])
                                  <a class="btn btn-info" href="{{ route('user.show',$user->id)}}">Show</a> 
                                @endcan
                                </td>  
                                <td> 
                                @can('view', [$user, ['user.edit','userown.edit'] ])
                                  <a class="btn btn-success" href="{{ route('user.edit',$user->id)}}">Edit</a> 
                                @endcan
                                </td>  
                                <td> 
                                @can('haveaccess','user.destroy')
                                  <form action="{{ route('user.destroy',$user->id)}}" method="POST">
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

                      {{ $users->links() }}




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
