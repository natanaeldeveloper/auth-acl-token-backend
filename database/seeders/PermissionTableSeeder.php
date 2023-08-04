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
            'name' => 'admin',
            'description' => 'Todas as permissões do admistrativo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $admin->id,
            'name' => 'admin:user',
            'description' => 'Gerenciamento de usuários incluindo: cadastro, edição e vinculo de papéis e permissões a usuários do sistema.',
        ]);

        $user = \App\Models\Permission::factory()->create([
            'name' => 'user',
            'description' => 'Todas as permissões de usuário.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $user->id,
            'name' => 'edit:profile',
            'description' => 'Edição de informações do próprio perfil.',
        ]);

        $tipoAnexo = \App\Models\Permission::factory()->create([
            'name' => 'tipo_anexo',
            'description' => 'Todas as permissões de tipos de anexos.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $tipoAnexo->id,
            'name' => 'create:tipo_anexo',
            'description' => 'Cadastro de tipo de anexo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $tipoAnexo->id,
            'name' => 'edit:tipo_anexo',
            'description' => 'Edição de tipo de anexo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $tipoAnexo->id,
            'name' => 'remove:tipo_anexo',
            'description' => 'Remoção de tipo de anexo.',
        ]);

        $orgao = \App\Models\Permission::factory()->create([
            'name' => 'orgao',
            'description' => 'Todas as permissões de orgãos.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $orgao->id,
            'name' => 'create:orgao',
            'description' => 'Cadastro de orgão.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $orgao->id,
            'name' => 'edit:orgao',
            'description' => 'Edição de orgão.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $orgao->id,
            'name' => 'remove:orgao',
            'description' => 'Remoção de orgão.',
        ]);

        $processo = \App\Models\Permission::factory()->create([
            'name' => 'processo',
            'description' => 'Todas as permissões de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'create:processo',
            'description' => 'Cadastro de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'edit:processo',
            'description' => 'Edição de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'read:processo',
            'description' => 'Leitura de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'baixar:processo',
            'description' => 'Baixar documento de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'cancelar:processo',
            'description' => 'Cancelamento de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'tramitar:processo',
            'description' => 'Tramitação de processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $processo->id,
            'name' => 'aditivo:processo',
            'description' => 'Adição de aditivo de processo.',
        ]);

        $anexo = \App\Models\Permission::factory()->create([
            'name' => 'anexo',
            'description' => 'Todas as permissões do processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $anexo->id,
            'name' => 'create:anexo',
            'description' => 'Cadastro de anexo ao processo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $anexo->id,
            'name' => 'baixar:anexo',
            'description' => 'Baixar documento do anexo.',
        ]);

        \App\Models\Permission::factory()->create([
            'permission_id' => $anexo->id,
            'name' => 'remove:anexo',
            'description' => 'Remoção de anexo.',
        ]);

        \App\Models\Permission::factory()->create([
            'name' => 'caixa_entrada',
            'description' => 'Define se o usuário possuirá caixa de entrada.',
        ]);

        \App\Models\Permission::factory()->create([
            'name' => 'caixa_saida',
            'description' => 'Define se o usuário possuirá caixa de saída.',
        ]);

        \App\Models\Permission::factory()->create([
            'name' => 'caixa_rascunho',
            'description' => 'Define se o usuário possuirá caixa de rascunho.',
        ]);
    }
}
