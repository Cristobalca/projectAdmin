@extends('adminlte::page')

@section('title', 'Editar Usuario')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h2>Editar Usuario</h2>
                    </div>
                    <div class="card-body">
                        @include('custom.message')
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="container">
                                <h3>Datos Requeridos</h3>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                        value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" placeholder="email" name="email"
                                        value="{{ old('email', $user->email) }}">
                                </div>
                                {{-- <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Nueva Contraseña" name="password"
                                        >
                                </div> --}}
                                @can('haveaccess','role.edit')
                                    
                                
                                <div class="form-group">
                                    <select class="form-control" name="roles" id="roles">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @isset($user->roles[0]->name)
                                                    @if ($role->name == $user->roles[0]->name)
                                                        selected
                                                    @endif
                                                @endisset
                                                >{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @endcan
                                <hr>
                                <input class="btn btn-primary" type="submit" value="Guardar">
                                <a class="btn btn-danger" href="{{ route('user.index') }}">Volver</a>


                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
