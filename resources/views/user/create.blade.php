@extends('adminlte::page')

@section('title', 'Crear Usuario')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h2>Crear Usuario</h2>
                    </div>
                    <div class="card-body">
                        @include('custom.message')
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="container">
                                <h3>Datos Requeridos</h3>
                                <strong>Nombre:</strong>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" placeholder="Nombre" name="name"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" placeholder="email" name="email"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password"
                                        >
                                </div>

                                <div class="form-group">                                    
                                    <select class="form-control" name="roles" id="roles">
                                        <option value="">Seleccionar un rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


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
