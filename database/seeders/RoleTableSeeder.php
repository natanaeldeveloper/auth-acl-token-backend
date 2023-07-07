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
            'id' => 1,
            'name' => 'SUPER ADMINISTRADOR',
            'description' => 'Possui acesso total ao sistema e às funcionalidades administrativas. Pode realizar qualquer ação e configurar permissões para outros usuários.'
        ]);

        \App\Models\Role::factory()->create([
            'id' => 2,
            'name' => 'ADMINISTRADOR',
            'description' => 'Pode gerenciar usuários, permissões e configurações do sistema, contendo limitações em determinadas áreas.'
        ]);

        \App\Models\Role::factory()->create([
            'id' => 3,
            'name' => 'MODERADOR',
            'description' => 'Responsável pela moderação e gerenciamento de conteúdo do sistema. Pode aprovar, editar ou excluir conteúdo gerado pelos usuários.'
        ]);

        \App\Models\Role::factory()->create([
            'id' => 4,
            'name' => 'USUÁRIO REGULAR',
            'description' => 'Possui acesso básico às funcionalidades principais do sistema, como visualização, criação e edição de conteúdo.'
        ]);

        DB::statement("SELECT setval(pg_get_serial_sequence('roles', 'id'), 4, false)");
    }
}
