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

* `admin`
    * `admin:user`
    * `admin:user_acl`
* `user`
    * `list:user`
    * `read:user`
    * `edit:user`
