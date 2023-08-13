<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Crear el rol "alumno"
       $role = Role::create(['name' => 'alumno']);

       // Asignar los permisos necesarios al rol "alumno"
       $permissions = [
           'ver-rol',
       ];

       $role->syncPermissions($permissions);
    }
}
