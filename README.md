# Personal Access Token + ACL

## Objetivo 
Padronizar e flexibilizar o gerenciamento de papeis e permissões de usuários dentro de um sistema utilizando autenticação via token.

## Tecnologias 
* `php 8.2`
* `laravel 10`

## Coleção de rotas (Postman)
[link para o arquivo](/2023_06_20_110437_collection_postman.json)

## Registros base de permissões

### Papéis

* SUPER ADMINISTRADOR
* ADMINISTRADOR
* MODERADOR
* USUÁRIO REGULAR

### Permissões

* `admin` - Todas as permissões do admistrativo.
    * `admin:user` - Gerenciamento de usuários incluindo: cadastro, edição e vinculo de papéis e permissões a usuários do sistema.
* `user` - Todas as permissões do usuário.
    * `edit:profile` - Edição de informações do próprio perfil.
* `tipo_anexo` - Todas as operações que envolvem os tipos de anexos.
    * `create:tipo_anexo` - Cadastro de tipo de anexo.
    * `edit:tipo_anexo` - Edição de tipo de anexo.
    * `remove:tipo_anexo` - Remoção de tipo de anexo.
* `orgao` - Todas as operações que envolvem o orgão.
    * `create:orgao` - Cadastro de orgão.
    * `edit:orgao` - Edição de orgão.
    * `remove:orgao` - Remoção de orgão.
* `processo` - Todas as permissões que envolvem o processo.
    * `create:processo` - Cadastro de processos.
    * `edit:processo` - Edição de processos.
    * `read:processo` - Leitura de processos.
    * `baixar:processo` - Baixar documento do processos.
    * `cancelar:processo` - Cancelamento de processos.
    * `tramitar:processo` - Tramitação de processos.
    * `aditivo:processo` - Adição de aditivos ao processo.
* `anexo` - Todas as permissões que envolvem o anexo.
    * `create:anexo` - Cadastro de anexo ao processo.
    * `baixar:anexo` - Baixar documento do anexo.
    * `remove:anexo` - Remoção de anexo.
* `caixa_entrada` - Define se o usuário possuirá caixa de entrada.
* `caixa_saida` - Define se o usuário possuirá caixa de saída.
* `caixa_rascunho` - Define se o usuário possuirá caixa de rascunho.
