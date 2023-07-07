<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TipoAnexoOrgaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipos_anexos_orgaos')->insert([
            'orgao_id' => 1,
            'tipo_anexo_id' => 1,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tipos_anexos_orgaos')->insert([
            'orgao_id' => 1,
            'tipo_anexo_id' => 2,
            'created_at' => Carbon::now(),
        ]);

        DB::table('tipos_anexos_orgaos')->insert([
            'orgao_id' => 1,
            'tipo_anexo_id' => 3,
            'created_at' => Carbon::now(),
        ]);
    }
}
