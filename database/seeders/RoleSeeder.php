<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'SUPERADMIN1']);
        $role2 = Role::create(['name' => 'CLIENTE']);
        $role3 = Role::create(['name' => 'SUPERADMIN2']);
        $role4 = Role::create(['name' => 'ADMINISTRADOR']);
        $role5 = Role::create(['name' => 'AUXADMIN']);

        //ADMINS
        Permission::create(['name' => 'admin.inicio'])->syncRoles([$role1, $role3,$role4,$role5]);
        Permission::create(['name' => 'admin.crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.clientes.index'])->syncRoles([$role1,$role3,$role4,$role5]);
        Permission::create(['name' => 'admin.clientes.crear'])->syncRoles([$role1,$role3,$role4,$role5]);
        Permission::create(['name' => 'admin.clientes.editar'])->syncRoles([$role1,$role3,$role4,$role5]);
        Permission::create(['name' => 'admin.extractos.index'])->syncRoles([$role1,$role3,$role4,$role5]);
        Permission::create(['name' => 'admin.extractos.pdf'])->syncRoles([$role1,$role3]);
        Permission::create(['name' => 'admin.solicitudes.index'])->syncRoles([$role1,$role3,$role4,$role5]);
        Permission::create(['name' => 'admin.inversiones.index'])->syncRoles([$role1,$role3,$role4,$role5]);
        Permission::create(['name' => 'admin.inversiones.create'])->syncRoles([$role1,$role3]);  
        Permission::create(['name' => 'admin.inversiones.editar'])->syncRoles([$role1,$role3]); 
        Permission::create(['name' => 'admin.kpis.index'])->syncRoles([$role1,$role3,$role4,$role5]); 
        Permission::create(['name' => 'admin.desembolsos.index'])->syncRoles([$role1,$role3,$role4,$role5]); 
        Permission::create(['name' => 'admin.desembolsos.editar'])->syncRoles([$role1,$role3]); 
        Permission::create(['name' => 'admin.cambiarcontrasena'])->syncRoles([$role1,$role3,$role4,$role5]); 


        //CLIENTES
        Permission::create(['name' => 'cliente.inicio'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.perfil.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.inversiones.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.desembolsos.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.extractos.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.solicitudes.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.documentos.index'])->syncRoles([$role2]);
        Permission::create(['name' => 'cliente.cambiarcontrasena'])->syncRoles([$role2]);

    }
}
