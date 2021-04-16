<?php

namespace App\Http\Controllers;

use App\CAPermission\Models\Permission;
use App\CAPermission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
   
    public function index()
    {
        Gate::authorize('haveaccess','role.index');

        $roles =  Role::latest()->paginate(5);

        return view('role.index',compact('roles'));
    }

    
    public function create()
    {
        Gate::authorize('haveaccess','role.create');

        $permissions = Permission::get();

        return view('role.create', compact('permissions'));


    }

    
    public function store(Request $request)
    {
        Gate::authorize('haveaccess','role.create');

        $request->validate([
            'name'          => 'required|max:50|unique:roles,name',
            'slug'          => 'required|max:50|unique:roles,slug',
            'full-access'   => 'required|in:yes,no'
        ]);

        $role = Role::create($request->all());
        
        //if ($request->get('permission')) {
            //return $request->all();
            $role->permissions()->sync($request->get('permission'));
        //}
        return redirect()->route('role.index')
            ->with('status_success','Role Creado Exitosamente'); 
       
    }

    public function show(Role $role)
    {
        $this->authorize('haveaccess','role.show');

        $permission_role=[];

        foreach($role->permissions as $permission) {
            $permission_role[]=$permission->id; 
        }
    
        $permissions = Permission::get();

        return view('role.view', compact('permissions','role','permission_role'));
    }

    
    public function edit(Role $role)
    {   

        $this->authorize('haveaccess','role.edit');
        $permission_role=[];

        foreach($role->permissions as $permission) {
            $permission_role[]=$permission->id; 
        }
    
        $permissions = Permission::get();

        return view('role.edit', compact('permissions','role','permission_role'));
        
    }

   
    public function update(Request $request, Role $role)
    {
        $this->authorize('haveaccess','role.edit');
        $request->validate([
            'name'          => 'required|max:50|unique:roles,name,'.$role->id,
            'slug'          => 'required|max:50|unique:roles,slug,'.$role->id,
            'full-access'   => 'required|in:yes,no'
        ]);

        $role->update($request->all());
        
            $role->permissions()->sync($request->get('permission'));
       
        return redirect()->route('role.index')
            ->with('status_success','Role Actualizado Exitosamente'); 
    }

   
    public function destroy(Role $role)
    {   
        $this->authorize('haveaccess','role.destroy');
        $role->delete();

        return redirect()->route('role.index')
            ->with('status_success','Role Borrado Exitosamente'); 
        
    }
}
