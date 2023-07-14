<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = \App\Models\Permission::factory()->create([
            'name' => '*',
            'description' => 'Permissão a todos os recursos do sistema.',
        ]);

        $admin = \App\Models\Permission::factory()->create([
            'name' => 'admin',
            'description' => 'Todas as permissões do admistrativo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $admin->id,
            'name' => 'admin:user',
            'description' => 'Gerenciamento de usuários do sistema.',
        ]);

        $user = \App\Models\Permission::factory()->create([
            'name' => 'user',
            'description' => 'Todas as permissões de um usuário comum do sistema.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $user->id,
            'name' => 'list:user',
            'description' => 'Leitura de usuários do sistema.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $user->id,
            'name' => 'read:user',
            'description' => 'Leitura de usuário.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $user->id,
            'name' => 'edit:user',
            'description' => 'Edição de usuário.',
        ]);

    }
}
