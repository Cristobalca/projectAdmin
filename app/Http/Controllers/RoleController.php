<?php

namespace App\Http\Controllers;

use App\CAPermission\Models\Permission;
use App\CAPermission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess','role.index');

        $roles =  Role::latest()->paginate(5);

        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess','role.create');

        $permissions = Permission::get();

        return view('role.create', compact('permissions'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            ->with('status_success','Role saved successfully'); 
       
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
        
        //if ($request->get('permission')) {
            //return $request->all();
            $role->permissions()->sync($request->get('permission'));
        //}
        return redirect()->route('role.index')
            ->with('status_success','Role updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {   
        $this->authorize('haveaccess','role.destroy');
        $role->delete();

        return redirect()->route('role.index')
            ->with('status_success','Role successfully removed'); 
        
    }
}
