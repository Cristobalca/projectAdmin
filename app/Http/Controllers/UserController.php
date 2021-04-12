<?php

namespace App\Http\Controllers;

use App\CAPermission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('haveaccess','user.index');
        $keyword = $request->get('search');
        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate(5);
        } else {
        $users =  User::with('roles')->latest()->paginate(7);
        }

        return view('user.index',compact('users'));
    }

 
    public function create(User $user)
    {
        //$this->authorize('create', User::class);
        $roles= Role::all();
        return view('user.create', compact('user','roles'));
    }


    public function store(Request $request)
    {
        
           $user =   User::create($request->all());
            $user->roles()->sync($request->get('roles'));

        return redirect()->route('user.index')
        ->with('status_success','Usuario Creado Exitosamente');
    }

   
    public function show(User $user)
    {
        $this->authorize('view', [$user, ['user.show','userown.show'] ]);
        $roles= Role::orderBy('name')->get();

        //return $roles;

        return view('user.view', compact('roles', 'user'));
    }

    
    public function edit(User $user)
    {
        $this->authorize('update', [$user, ['user.edit','userown.edit'] ]);
        $roles= Role::orderBy('name')->get();

        //return $roles;

        return view('user.edit', compact('roles', 'user'));
    }

    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required|max:50|unique:users,name,'.$user->id,
            'email'         => 'required|max:50|unique:users,email,'.$user->id            
        ]);

        //dd($request->all());

        $user->update($request->all());

        $user->roles()->sync($request->get('roles'));
        
        return redirect()->route('user.index')
            ->with('status_success','usuario Actualizado Exitosamente'); 

    }


    public function destroy(User $user)
    {
        $this->authorize('haveaccess','user.destroy');
        $user->delete();

        return redirect()->route('user.index')
            ->with('status_success','Usuario Borrado Exitosamente'); 
    }
}
