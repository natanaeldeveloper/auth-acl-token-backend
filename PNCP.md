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
