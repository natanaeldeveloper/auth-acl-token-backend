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
        ])->permissions()->attach([1, 3, 5, 9, 13, 21, 25, 26, 27]);

        DB::statement("SELECT setval(pg_get_serial_sequence('roles', 'id'), 2, false)");
    }
}
