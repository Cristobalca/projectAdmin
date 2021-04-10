<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\CAPermission\Models\Permission;
use App\CAPermission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CAPermissiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Re estrutural el seeder para que funcione en Producion y se escalable
     * y se le puedan agregar mas permisos
     */
    public function run()
    {
        //truncate tables
        DB::statement("SET foreign_key_checks=0");
            DB::table('role_user')->truncate();
            DB::table('permission_role')->truncate();
            Permission::truncate();
            Role::truncate();
        DB::statement("SET foreign_key_checks=1");



        //user admin
        $useradmin= User::where('email','admin@admin.com')->first();
        if ($useradmin) {
            $useradmin->delete();
        }
        $useradmin= User::create([
            'name'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('admin123')    
        ]);

        //rol admin
        $roladmin=Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrador',
            'full-access' => 'yes'
    
        ]);
            //rol Manager
        $rolamanager=Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Manager',
            'full-access' => 'no'
    
        ]);

         //rol Empleado User
         $roluser=Role::create([
            'name' => 'Empleado',
            'slug' => 'empleado',
            'description' => 'Empleado',
            'full-access' => 'no'
    
        ]);
        
        //table role_user
        $useradmin->roles()->sync([ $roladmin->id ]);
      
        
        //permission
        $permission_all = [];

        
        //permission role
        $permission = Permission::create([
            'name' => 'List role',
            'slug' => 'role.index',
            'description' => 'El usuario Puede  listar role',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Show role',
            'slug' => 'role.show',
            'description' => 'El usuario Puede  ver role',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Create role',
            'slug' => 'role.create',
            'description' => 'El usuario Puede crear role',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Edit role',
            'slug' => 'role.edit',
            'description' => 'El usuario Puede editar role',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Destroy role',
            'slug' => 'role.destroy',
            'description' => 'El usuario Puede  Eliminar role',
        ]);

        $permission_all[] = $permission->id;
    
        


        //permission user
        $permission = Permission::create([
            'name' => 'List user',
            'slug' => 'user.index',
            'description' => 'El usuario Puede listar usuarios',
        ]);
        $permission = Permission::create([
            'name' => 'Create user',
            'slug' => 'user.create',
            'description' => 'El usuario Puede create user',
        ]);
        
        $permission_all[] = $permission->id;
        
        $permission = Permission::create([
            'name' => 'Show user',
            'slug' => 'user.show',
            'description' => 'El usuario Puede  ver user',
        ]);        
        
        $permission_all[] = $permission->id;
        
        $permission = Permission::create([
            'name' => 'Edit user',
            'slug' => 'user.edit',
            'description' => 'El usuario Puede  edit user',
        ]);
        
        $permission_all[] = $permission->id;
        
        $permission = Permission::create([
            'name' => 'Destroy user',
            'slug' => 'user.destroy',
            'description' => 'El usuario Puede  destroy user',
        ]);
        
        $permission_all[] = $permission->id;


        //new
        $permission = Permission::create([
            'name' => 'Show own user',
            'slug' => 'userown.show',
            'description' => 'El usuario Puede  ver own user',
        ]);        
        
        $permission_all[] = $permission->id;
        
        $permission = Permission::create([
            'name' => 'Edit own user',
            'slug' => 'userown.edit',
            'description' => 'El usuario Puede  editar own user',
        ]);
        


        
        /*
        
        $permission_all[] = $permission->id;
        */
        
        //table permission_role
        //$roladmin->permissions()->sync( $permission_all);

        $permission_all[] = $permission->id;

        // permission Project
        $permission = Permission::create([
            'name' => 'List project',
            'slug' => 'project.index',
            'description' => 'El usuario Puede  listar Proyectos',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Show project',
            'slug' => 'project.show',
            'description' => 'El usuario Puede  ver Proyectos',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Create project',
            'slug' => 'project.create',
            'description' => 'El usuario Puede crear Proyectos',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Edit project',
            'slug' => 'project.edit',
            'description' => 'El usuario Puede editar Proyectos',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Destroy project',
            'slug' => 'project.destroy',
            'description' => 'El usuario Puede  Eliminar Proyectos',
        ]);

        // $permission_all[] = $permission->id;


        // permission Taks
        // $permission = Permission::create([
        //     'name' => 'List task',
        //     'slug' => 'task.index',
        //     'description' => 'El usuario Puede  listar Tareas',
        // ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Show task',
            'slug' => 'task.show',
            'description' => 'El usuario Puede  ver Tareas',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Create task',
            'slug' => 'task.create',
            'description' => 'El usuario Puede crear Tareas',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Edit task',
            'slug' => 'task.edit',
            'description' => 'El usuario Puede editar Tareas',
        ]);

        $permission_all[] = $permission->id;
                
        $permission = Permission::create([
            'name' => 'Destroy task',
            'slug' => 'task.destroy',
            'description' => 'El usuario Puede  Eliminar Tareas',
        ]);

        $permission_all[] = $permission->id;
                                
        $permission = Permission::create([
            'name' => 'checked own task',
            'slug' => 'checkedown.task',
            'description' => 'Marcar Tarea como compleatada ',
        ]);

        $permission_all[] = $permission->id;
                                
        $permission = Permission::create([
            'name' => 'checked asign task',
            'slug' => 'checkedasign.task',
            'description' => 'Marcar Tarea Asignada como compleatada ',
        ]);

        $roladmin->permissions()->sync($permission_all);


    }
}


