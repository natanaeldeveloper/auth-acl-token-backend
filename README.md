# API Licitação - ALECE

## Tecnologias 
* `php 8.2`
* `laravel 10`

## Registros base de permissões

### Papéis (ainda não concluído)

* SUPER ADMINISTRADOR
* ADMINISTRADOR

### Permissões (ainda não concluído)

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
    * `assinar:anexo` - Assinar anexo.
* `ata` - Todas as permissões de ata.
    * `write:ata` - Escrita (Cadastro e Edição) de Ata de Registro de Preço.
    * `read:ata` - Leitura de Ata de Registro de Preço. 
* `contrato` - Todas as permissões de contrato.
    * `write:contrato` - Escrita (Cadastro e Edição) de Contrato.
    * `read:contrato` - Leitura de Contrato. 
* `caixa_entrada` - Define se o usuário possuirá caixa de entrada.
* `caixa_saida` - Define se o usuário possuirá caixa de saída.
* `caixa_rascunho` - Define se o usuário possuirá caixa de rascunho.
