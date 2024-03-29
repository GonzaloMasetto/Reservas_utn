<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;


class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla places
            'ver-place',
            'crear-place',
            'editar-place',
            'borrar-place',

            //Operacions sobre tabla events
            'ver-event',
            'crear-event',
            'editar-event',
            'borrar-event',
            'ver-eventconfirmados',

            //Operacions sobre tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

             //Operacions sobre tabla tipo de eventos
             'ver-typeEvent',
             'crear-typeEvent',
             'editar-typeEvent',
             'borrar-typeEvent',

             //Operacions sobre tabla componentes de tic
             'ver-ticComponent',
             'crear-ticComponent',
             'editar-ticComponent',
             'borrar-ticComponent'
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
