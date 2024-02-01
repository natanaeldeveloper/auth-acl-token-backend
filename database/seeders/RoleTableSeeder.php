<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::factory()->create([
            'name' => 'SUPER ADMINISTRADOR',
            'description' => 'Possui acesso total ao sistema e às funcionalidades administrativas. Pode realizar qualquer ação e configurar permissões para outros usuários.'
        ]);

        \App\Models\Role::factory()->create([
            'name' => 'ADMINISTRADOR',
            'description' => 'Pode gerenciar usuários, permissões e configurações do sistema, contendo limitações em determinadas áreas.'
        ]);
    }
}