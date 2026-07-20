# Teste de Desenvolvimento - CodeIgniter 4

## Visão geral

Este projeto é um sistema simples de gerenciamento de tarefas feito em CodeIgniter 4.
A aplicação implementa o CRUD completo de tarefas e também inclui uma API RESTful para testes via Postman.

## Estrutura do projeto relevante

- `app/Controllers/TaskController.php` — controladora da interface web.
- `app/Controllers/TaskApiController.php` — controladora da API REST.
- `app/Models/TaskModel.php` — model de tarefas usando Query Builder do CodeIgniter.
- `app/Views/tasks/` — views para listagem, criação e edição.
- `app/Config/Routes.php` — rotas web e rotas da API.

## Requisitos do ambiente

- PHP 8.2 ou superior
- MySQL ou PostgreSQL
- Composer
- Extensões: `intl`, `mbstring`, `json`, `mysqli` ou `pgsql` conforme banco usado

## Como rodar localmente

> **Importante:** antes de executar os comandos abaixo, certifique-se de que você tem um servidor local em execução (por exemplo XAMPP, Laragon ou WAMP) com **Apache** e **MySQL** iniciados.

1. Copie o arquivo de ambiente:
   ```bash
   copy env .env
   ```
2. Ajuste os dados de conexão no `.env`:
   ```ini
   app.baseURL = 'http://localhost:8080/'
   database.default.hostname = localhost
   database.default.database = nome_do_banco
   database.default.username = seu_usuario
   database.default.password = sua_senha
   database.default.DBDriver = MySQLi
   ```
3. Instale dependências (se necessário):
   ```bash
   composer install
   ```
4. Inicie o servidor integrado do CodeIgniter:
   ```bash
   php spark serve
   ```
5. Acesse a aplicação em:
   ```text
   http://localhost:8080
   ```

## Rotas e endpoints

### Web (interface)

- `GET /` — lista todas as tarefas.
- `GET /create` — exibe formulário de criação.
- `POST /store` — envia criação de tarefa.
- `GET /edit/{id}` — exibe formulário de edição.
- `POST /update/{id}` — envia atualização de tarefa.
- `GET /delete/{id}` — exclui tarefa.

### API REST (testada no Postman)

> **Dica para o avaliador:** Para facilitar a validação dos endpoints, adicionei o arquivo `postman_collection.json` na raiz deste projeto.
>
> Importar no Postman:
>
> 1. Abra o Postman.
> 2. Clique em `Import`.
> 3. Selecione o arquivo `postman_collection.json`.
> 4. Execute as requisições da coleção.

As rotas abaixo foram testadas no Postman.

Base URL da API: `http://localhost:8080/api/tasks`

- `GET /api/tasks`
  - Descrição: lista todas as tarefas.
  - Retorno: JSON com todas as tarefas.

- `GET /api/tasks/{id}`
  - Descrição: busca tarefa específica.
  - Exemplo: `GET /api/tasks/29`

- `POST /api/tasks`
  - Descrição: cria uma nova tarefa.
  - Body JSON:
    ```json
    {
      "title": "Dominar POST na API",
      "description": "Enviando dados do Postman para o CodeIgniter",
      "status": "pendente"
    }
    ```

- `PUT /api/tasks/{id}`
  - Descrição: atualiza tarefa existente.
  - Body JSON:
    ```json
    {
      "title": "Tarefa atualizada",
      "description": "Atualizando dados via método PUT",
      "status": "concluida"
    }
    ```

- `DELETE /api/tasks/{id}`
  - Descrição: exclui tarefa existente.
  - Exemplo: `DELETE /api/tasks/29`

## Validação e segurança

- Validação de dados no formulário e na API usando as regras do CodeIgniter.
- `TaskModel` define `allowedFields` para proteger contra mass assignment.
- A aplicação usa Query Builder/Model do CodeIgniter, reduzindo risco de SQL Injection.
- CSRF Protection do CodeIgniter 4 está disponível e pode ser habilitada nos filtros.

## Banco de dados

A tabela principal é `tasks` com esta estrutura:

```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  status ENUM('pendente', 'em andamento', 'concluída') DEFAULT 'pendente',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Checklist de conformidade

| Requisito                       | Status | Observações                                    |
| ------------------------------- | ------ | ---------------------------------------------- |
| Framework: CodeIgniter 4        | ✅     | Usado em todo o projeto                        |
| Banco de dados MySQL/PostgreSQL | ✅     | Suporta MySQL via MySQLi                       |
| ORM/Query Builder               | ✅     | `TaskModel` estende `Model` do CI4             |
| Validação do CodeIgniter        | ✅     | Aplicada em formulários e API                  |
| Interface simples               | ✅     | Views em `app/Views/tasks/`                    |
| Segurança CSRF                  | ✅     | Proteção do CI4 disponível em filtros          |
| Rotas amigáveis                 | ✅     | Web e API definidas em `app/Config/Routes.php` |
| API REST (bônus)                | ✅     | `TaskApiController` implementa CRUD JSON       |

## Observações para o avaliador

- A API REST responde em JSON nas rotas `/api/tasks`.
- O controlador `TaskApiController` usa retornos padronizados do `ResourceController`.
- A arquitetura segue MVC e uso recomendado do CodeIgniter.
- Todos os endpoints foram testados via Postman.
- A coleção do Postman está incluída no arquivo `postman_collection.json` na raiz do projeto.
