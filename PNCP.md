# Manual de Integração PNCP (V2.2.52)

## 1. Objetivo

Este documento contempla as orientações para realizar a integração de sistemas externos com 
as API REST do PNCP (Portal Nacional de Contratações Públicas)

## 2. Protocolo de Comunicação

* [x] Protocolo de comunicação: `REST`
* [x] Notação dos dados de tráfego: `JSON`
* [x] Padrão de dados trafegados via header: `charset ISO-8859-1`
* [x] Codificação de dados (quando possível): `charset UTF-8`

## 3. Acesso ao PNCP

### 3.1. Endereços de Acesso

A invocação dos serviços será realizada através das URLs citadas abaixo, conforme requisitos 
de segurança detalhados na seção seguinte.

<table border="1">
  <thead>
    <tr>
      <th colspan="2">Ambiente de Homologação Externa</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Portal</td>
      <td><a href="https://treina.pncp.gov.br">https://treina.pncp.gov.br</a></td>
    </tr>
    <tr>
      <td>Documentação Técnica (Serviços)</td>
      <td><a href="https://treina.pncp.gov.br/api/pncp/swagger-ui/index.html?configUrl=/pncp-api/v3/api-docs/swagger-config">https://treina.pncp.gov.br/api/pncp/swagger-ui/index.html?configUrl=/pncp-api/v3/api-docs/swagger-config</a></td>
    </tr>
    <tr>
      <td>Serviços (${BASE_URL})</td>
      <td><a href="https://treina.pncp.gov.br/api/pncp">https://treina.pncp.gov.br/api/pncp</a></td>
    </tr>
  </btbody>
</table>

<table border="1">
  <thead>
    <tr>
      <th colspan="2">Ambiente de Produção</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Portal</td>
      <td><a href="https://pncp.gov.br">https://pncp.gov.br</a></td>
    </tr>
    <tr>
      <td>Documentação Técnica (Serviços)</td>
      <td><a href="https://pncp.gov.br/api/pncp/swagger-ui/index.html?configUrl=/pncp-api/v3/api-docs/swagger-config">https://pncp.gov.br/api/pncp/swagger-ui/index.html?configUrl=/pncp-api/v3/api-docs/swagger-config</a></td>
    </tr>
    <tr>
      <td>Serviços (${BASE_URL})</td>
      <td><a href="https://pncp.gov.br/api/pncp">https://pncp.gov.br/api/pncp</a></td>
    </tr>
  </btbody>
</table>

Nota: ${BASE_URL} será utilizada nos exemplos de requisições citados neste documento. É a URL base para acesso aos serviços disponíveis no PNCP.

### 3.2. Autenticação/Autorização

* As plataformas digitais que fornecerão os dados para publicação, representando os órgãos públicos e entidades, <mark> deverão realizar credenciamento junto ao Ministério da Gestão e da 
Inovação em Serviços Públicos, quando receberão login e senha para acesso. </mark>

* A API de login (POST https://pncp.gov.br/api/pncp/v1/usuarios/login) <mark> retorna o JWT no 
cabeçalho (header) da resposta HTTP, especificamente no campo “Authorization”, após o texto 
“Bearer”. </mark> As requisições a APIs de manutenção de dados no PNCP requerem esse campo de 
cabeçalho idêntico para autenticação e autorização

* Quando da primeira publicação do sistema, a associação entre usuários e seus 
órgãos/entidades autorizados estará sendo feita pelo próprio usuário. Ou seja, <mark>a plataforma 
deverá informar ao sistema quais CNPJs ela representa e assim estará autorizada a enviar 
dados em nome destes. </mark> O sistema confiará na plataforma e ela será juridicamente responsável 
por quaisquer equívocos, intencionais ou acidentais

## 4. Recomendações Iniciais

### 4.1. Cadastro Inicial dos Órgãos/Entidades e suas Unidades

<mark>A plataforma digital deverá ter cadastrado os órgãos/entidades e suas respectivas unidades  compradoras antes de enviar os dados das contratações realizadas por estas. </mark>
Uma vez habilitada, a plataforma usuária deve realizar os seguintes passos:
1. Realizar Login 
2. Verificar se o(s) órgão(s) desejados já estão cadastrados no PNCP
3. Cadastrar as unidades compradoras desses órgãos
4. Vincular os entes autorizados junto ao seu login de usuário, conforme orientação 
contida no tópico 6.1.5 deste manual.
5. Iniciar o envio das informações através dos serviços disponíveis

* Nota: O portal PNCP já possui, previamente cadastrados, os principais CNPJs da 
administração pública divulgados pela RFB. Caso não encontre o órgão desejado, favor inserir 
antes de seguir para o próximo passo.

## 6. Catalogo de Serviços (APIs)

### Observações

_Há algumas nomeclaturas usadas na PNCP que seus significados diferem dos usados no sistema de licitação._
### 6.1. Serviços de Usuário

<table>
  <thead>
  <tr>
    <th>Endepoint</th>
    <th>Método HTTP</th>
    <th>Descrição</th>
    <th>Referência</th>
    <th>Mais detalhes</th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td>/v1/usuarios/{id}</td>
      <td>PUT</td>
      <td>Atualizar Usuário</td>
      <td>6.1.1</td>
      <td>Com esse serviço é possível que o usuário altere sua própria senha [...]</td>
    </tr>
    <tr>
      <td>/v1/usuarios/{id}</td>
      <td>GET</td>
      <td>Consultar Usuário pelo ID</td>
      <td>6.1.2</td>
      <td>--</td>
    </tr>
    <tr>
      <td>/v1/usuarios</td>
      <td>GET</td>
      <td>Consultar Usuário por Login ou por CPF/CNPJ</td>
      <td>6.1.3</td>
      <td>--</td>
    </tr>
    <tr>
      <td>/v1/usuarios/login</td>
      <td>POST</td>
      <td>Realizar Login de Usuário</td>
      <td>6.1.4</td>
      <td>Serviço que recebe os dados para autenticação de um usuário e retorna um token de acesso.</td>
    </tr>
    <tr>
      <td>/v1/usuarios/{id}/orgaos</td>
      <td>POST</td>
      <td>Inserir Entes Autorizados para um Usuário</td>
      <td>6.1.5</td>
      <td>--</td>
    </tr>
    <tr>
      <td>/v1/usuarios/{id}/orgaos</td>
      <td>DELETE</td>
      <td>Excluir Entes Autorizados de um Usuário</td>
      <td>6.1.6</td>
      <td>--</td>
    </tr>
  </tboby>
</table>

### 6.2. Serviços de Órgão/Entidade

<table>
  <thead>
  <tr>
    <th>Endepoint</th>
    <th>Método HTTP</th>
    <th>Descrição</th>
    <th>Referência</th>
    <th>Mais detalhes</th>
  </tr>
  </thead>
  <tbody>
    <tr>
      <td>/v1/orgaos</td>
      <td>POST</td>
      <td>Incluir Órgão (Entes da Federação)</td>
      <td>6.2.1</td>
      <td>Obs.: Este serviço não pode ser confundido com o serviço 6.1.1., que cadastra a lista de CNPJs 
dos entes autorizados (órgão) o qual o usuário estar-se-á apto a divulgar informações</td>
    </tr>
    <tr>
      <td>/v1/orgaos/{cnpj}</td>
      <td>GET</td>
      <td>Consultar Órgão por Cnpj</td>
      <td>6.2.2</td>
      <td>--</td>
    </tr>
    <tr>
      <td>/v1/orgaos/{cnpj}/unidades</td>
      <td>POST</td>
      <td>Incluir Unidade</td>
      <td>6.2.3</td>
      <td><mark>As unidades são divisões 
administrativas que realizam as contratações e celebram os contratos. Todo órgão/entidade 
deverá ter cadastrado ao menos uma unidade no PNCP. </mark> Para a inclusão de nova unidade 
obrigatoriamente o órgão/entidade deve estar como ente autorizado do usuário. Exemplo:
  - Órgão: Município de Itapuranga
  - Unidade Administrativa: Fundo Municipal de Assistência Socia</td>
    </tr>
    <tr>
      <td>/v1/orgaos/{cnpj}/unidades/{codigoUnidade}</td>
      <td>GET</td>
      <td>Consultar Unidade</td>
      <td>6.2.4</td>
      <td>--</td>
    </tr>
    <tr>
      <td>/v1/orgaos/{cnpj}/unidades</td>
      <td>GET</td>
      <td>Consultar Unidades de um Órgão</td>
      <td>6.2.5</td>
      <td>--</td>
    </tr>
  </tboby>
</table>

* usuários
* orgão/unidades
* Contratação 
* documentos de contratação
* Itens da contratação
* resultado do item de uma contratação
* imagem de um item de uma contratação
* Atas
* documento de atas
* termos de contrato
* documento do termo de contrato
* plano de contratação
* itens do plano de contratação