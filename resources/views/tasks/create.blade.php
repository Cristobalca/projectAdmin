@extends('layouts.app')

@section('content')
<div class="row col-8 justify-content-md-center" >
<h3>Crear Tarea</h3>
<form action="{{ route('tasks.store') }}" method="POST">
    
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
                    <textarea class="form-control" style="height:50px" name="description"
                        placeholder="Descripcion"></textarea>
                </div>
            </div>
        
                <div class="form-group" >
               <input type="hidden" name="project_id" class="form-control readOnly" placeholder="Name Project "
                  value=" {{ $id}}" 
               > 
               
               <input type="hidden" name="user_created_id" class="form-control readOnly" placeholder="Name Project "
               value=" {{ auth()->user()->id}}" 
            >
                </div>

            <div class="form-group">
                <label for="user_id">Asignar A:</label>
                <select name="user_assigned_id" class="form-control">
                    <option value="">Lista de usuarios</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        
                <div class="form-group">

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
           
        </div>
        </form>
</div>

@endsection