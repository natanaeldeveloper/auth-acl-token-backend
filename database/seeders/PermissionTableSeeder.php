<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissões relacionadas a entidade usuário

        \App\Models\Permission::factory()->create([
            'id' => 1,
            'name' => 'user:write',
            'description' => 'Escrita de usuários.',
        ]);

        \App\Models\Permission::factory()->create([
            'id' => 2,
            'permission_id' => 1,
            'name' => 'user:list',
            'description' => 'Leitura de usuários.',
        ]);

        \App\Models\Permission::factory()->create([
            'id' => 3,
            'permission_id' => 1,
            'name' => 'user:read',
            'description' => 'Leitura de usuário.',
        ]);

        \App\Models\Permission::factory()->create([
            'id' => 4,
            'permission_id' => 1,
            'name' => 'user:edit',
            'description' => 'Edição de usuário.',
        ]);

        // Permissões relacionadas a entidade permissões

        \App\Models\Permission::factory()->create([
            'id' => 5,
            'name' => 'permission:write',
            'description' => 'Escrita de permissões.',
        ]);

        \App\Models\Permission::factory()->create([
            'id' => 6,
            'permission_id' => 5,
            'name' => 'permission:list',
            'description' => 'Leitura de permissões.',
        ]);

        // Permissões relacionadas a entidade papeis

        \App\Models\Permission::factory()->create([
            'id' => 7,
            'name' => 'role:write',
            'description' => 'Escrita de Papéis.',
        ]);

        \App\Models\Permission::factory()->create([
            'id' => 8,
            'permission_id' => 7,
            'name' => 'role:list',
            'description' => 'Leitura de Papéis.',
        ]);

        // Permissões relacionadas ao vínculo de permissões e papéis aos usuários

        \App\Models\Permission::factory()->create([
            'id' => 9,
            'name' => 'user_access:write',
            'description' => 'Vínculo de permissões e papéis aos usuários.',
        ]);

        \App\Models\Permission::factory()->create([
            'id' => 10,
            'permission_id' => 9,
            'name' => 'user_access:list',
            'description' => 'Leitura de permissões e papéis dos usuários.',
        ]);

        // permissões de administrador

        \App\Models\Permission::factory()->create([
            'id' => 11,
            'name' => 'admin:user',
            'description' => 'Escrita de usuários incluíndo administradores.',
        ]);

        DB::statement("SELECT setval(pg_get_serial_sequence('permissions', 'id'), 11, false)");
    }
}
