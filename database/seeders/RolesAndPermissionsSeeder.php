<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Personas
            'ver personas',
            'crear personas',
            'editar personas',
            'eliminar personas',
            // CV secciones
            'gestionar formacion',
            'gestionar experiencia',
            'gestionar produccion',
            'gestionar congresos',
            'gestionar reconocimientos',
            'gestionar licencias',
            'gestionar membresias',
            'gestionar documentos personales',
            // Usuarios
            'gestionar usuarios',
            // Reportes
            'ver reportes',
            'exportar datos',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Administrador: acceso total
        $admin = Role::firstOrCreate(['name' => 'administrador']);
        $admin->givePermissionTo(Permission::all());

        // Supervisor: puede ver y editar todo, pero no gestionar usuarios
        $supervisor = Role::firstOrCreate(['name' => 'supervisor']);
        $supervisor->givePermissionTo([
            'ver personas', 'crear personas', 'editar personas',
            'gestionar formacion', 'gestionar experiencia', 'gestionar produccion',
            'gestionar congresos', 'gestionar reconocimientos', 'gestionar licencias',
            'gestionar membresias', 'gestionar documentos personales',
            'ver reportes', 'exportar datos',
        ]);

        // Docente: solo su propio CV
        $docente = Role::firstOrCreate(['name' => 'docente']);
        $docente->givePermissionTo([
            'ver personas',
            'gestionar formacion', 'gestionar experiencia', 'gestionar produccion',
            'gestionar congresos', 'gestionar reconocimientos', 'gestionar licencias',
            'gestionar membresias', 'gestionar documentos personales',
        ]);

        // Administrativo: solo su propio CV
        $administrativo = Role::firstOrCreate(['name' => 'administrativo']);
        $administrativo->givePermissionTo([
            'ver personas',
            'gestionar formacion', 'gestionar experiencia',
            'gestionar documentos personales',
        ]);

        $this->command->info('Roles y permisos creados exitosamente.');
    }
}
