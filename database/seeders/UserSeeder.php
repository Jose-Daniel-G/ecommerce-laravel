<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\Profesor;
use App\Models\Horario;
use App\Models\Cliente;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrador',
            'last_name' => 'Admin ',
            'document_type'=>1,
            'document_number'=>'123123123',
            'phone' => '9514268',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Jose Daniel',
            'last_name' => 'Grijalba Osorio',
            'document_type'=>1,
            'document_number'=>'123123123',
            'phone' => '9514268',
            'email' => 'jose.jdgo97@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'),
        ])->assignRole('superAdmin');
        User::factory(100)->create();

    }
}
