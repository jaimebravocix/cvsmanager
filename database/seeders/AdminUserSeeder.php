<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@universidad.edu'],
            [
                'name'     => 'Administrador Sistema',
                'password' => Hash::make('Admin@1234'),
                'activo'   => true,
            ]
        );
        $admin->assignRole('administrador');

        // Supervisor
        $supervisor = User::firstOrCreate(
            ['email' => 'supervisor@universidad.edu'],
            [
                'name'     => 'Supervisor RR.HH.',
                'password' => Hash::make('Super@1234'),
                'activo'   => true,
            ]
        );
        $supervisor->assignRole('supervisor');

        // Docente demo
        $docente = User::firstOrCreate(
            ['email' => 'docente@universidad.edu'],
            [
                'name'     => 'Dr. Juan Pérez García',
                'password' => Hash::make('Doc@1234'),
                'activo'   => true,
            ]
        );
        $docente->assignRole('docente');

        // Crear perfil de persona para el docente
        Persona::firstOrCreate(
            ['user_id' => $docente->id],
            [
                'apellido_paterno'    => 'Pérez',
                'apellido_materno'    => 'García',
                'nombres'             => 'Juan Carlos',
                'sexo'                => 'M',
                'tipo_personal'       => 'docente',
                'codigo_personal'     => 'DOC-001',
                'lugar_nacimiento'    => 'Lima',
                'pais_nacimiento'     => 'Perú',
                'celular'             => '987654321',
                'resumen_profesional' => 'Doctor en Ciencias de la Computación con 15 años de experiencia en docencia universitaria e investigación en IA.',
                'activo'              => true,
            ]
        );

        // Administrativo demo
        $admtvo = User::firstOrCreate(
            ['email' => 'administrativo@universidad.edu'],
            [
                'name'     => 'María López Torres',
                'password' => Hash::make('Adm@1234'),
                'activo'   => true,
            ]
        );
        $admtvo->assignRole('administrativo');

        Persona::firstOrCreate(
            ['user_id' => $admtvo->id],
            [
                'apellido_paterno'    => 'López',
                'apellido_materno'    => 'Torres',
                'nombres'             => 'María Elena',
                'sexo'                => 'F',
                'tipo_personal'       => 'administrativo',
                'codigo_personal'     => 'ADM-001',
                'activo'              => true,
            ]
        );

        $this->command->info('Usuarios de demostración creados.');
        $this->command->table(
            ['Rol', 'Email', 'Contraseña'],
            [
                ['administrador',  'admin@universidad.edu',          'Admin@1234'],
                ['supervisor',     'supervisor@universidad.edu',      'Super@1234'],
                ['docente',        'docente@universidad.edu',         'Doc@1234'],
                ['administrativo', 'administrativo@universidad.edu',  'Adm@1234'],
            ]
        );
    }
}
