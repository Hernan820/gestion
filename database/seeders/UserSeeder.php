<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    //  $permission = Permission::create(['name' => 'crear_cita']);
    //     $permission = Permission::create(['name' => 'editar_cita']);
    //     $permission = Permission::create(['name' => 'cancelar_cita']);
    //     $permission = Permission::create(['name' => 'reagendar_cita']);
    //     $permission = Permission::create(['name' => 'confirmar_cita']);

        $administrador = Role::create(['name' => 'administrador']);
        $usuario = Role::create(['name' => 'usuario']);
        // $agente = Role::create(['name' => 'agente']);
        
    //     $administrador->givePermissionTo([
    //         'crear_cita',
    //         'editar_cita',
    //         'cancelar_cita',
    //         'reagendar_cita',
    //         'confirmar_cita'
    //     ]);

    //     $usuario->givePermissionTo([
    //         'cancelar_cita',
    //         'reagendar_cita',
    //         'confirmar_cita'
    //     ]);

    //     $agente->givePermissionTo([
    //         'crear_cita',
    //         'editar_cita',
    //         'cancelar_cita',
    //         'reagendar_cita',
    //     ]);

    //   $user = User::create([
    //         'name' => 'admin',
    //         'email' => 'admin@gmail.com',
    //         'password' => Hash::make('admin123'),
    //         'site'   => '1',
    //         'estado_user' => '1'

    //     ]);

        $user = User::find(1);
        $user->assignRole('administrador'); 

    }
}
