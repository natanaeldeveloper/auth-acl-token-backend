<?php

return [
    'created' => [
        'success' => 'Recurso criado(a) com sucesso.',
        'error' => 'Erro ao criar o recurso.',
    ],

    'updated' => [
        'success' => 'Recurso atualizado(a) com sucesso.',
        'error' => 'Erro ao atualizar o recurso.',
    ],

    'deleted' => [
        'success' => 'Recurso removido(a) com sucesso.',
        'error' => 'Erro ao remover o recurso.',
    ],

    'logout' => 'Logout bem-sucedido.',

    "exceptions" => [
        "400" => "A solicitação enviada é inválida.",
        "401" => "A solicitação requer autenticação ou as credenciais fornecidas são inválidas.",
        "403" => "O acesso ao recurso é proibido. Você não tem permissão para acessá-lo.",
        "404" => "O recurso solicitado não foi encontrado.",
        "405" => "O método de requisição utilizado não é permitido para este recurso.",
        "422" => "Ocorreram erros de validação. Por favor, verifique os dados enviados.",
        "500" => "Ocorreu um erro interno no servidor.",
        "503" => "O serviço não está disponível no momento. Tente novamente mais tarde."
    ],
];
