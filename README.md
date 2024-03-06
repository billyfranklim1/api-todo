# Todo

A aplicação **Todo** é uma API RESTful desenvolvida com Laravel 8 e MySQL. O objetivo é fornecer um exemplo de aplicação Laravel com testes de integração. A aplicação permite criar, listar, atualizar e excluir tarefas. Ela também permite marcar uma tarefa como concluída. Podendo ser consumida por qualquer cliente que suporte requisições HTTP.

## Pré-requisitos ✅

- Composer
- Docker
- Docker Compose
- git

**Importante:** Laravel Sail utiliza a porta `3306` para o MySQL por padrão. Certifique-se de que esta porta esteja disponível 🚦 ou ajuste a configuração conforme necessário.


## Como Clonar o Projeto 📋

Para clonar o projeto, abra um terminal e execute o seguinte comando:

```bash
git clone https://github.com/billyfranklim1/api-todo.git
```

🎉 Após clonar o repositório, entre no diretório do projeto:

```bash
cd api-todo
```

## Configuração Inicial 🔧

Copie o arquivo `.env.example` para `.env` para configurar o ambiente:

```bash
cp .env.example .env
```

## Instalação e Configuração do Laravel Sail 🚀

Instale as dependências do projeto:

```bash
composer install --ignore-platform-reqs
```

Inicie os contêineres Docker com Laravel Sail 🐳:

```bash
./vendor/bin/sail up --build
```

Gere a chave da aplicação Laravel 🔑:

```bash
./vendor/bin/sail artisan key:generate
```

Execute as migrações para criar as tabelas no banco de dados 🗃️:

```bash
./vendor/bin/sail artisan migrate
```

Se desejar, você pode popular o banco de dados com dados de exemplo executando as seeds:

```bash
./vendor/bin/sail artisan db:seed
```

## Como Rodar os Testes 🧪

Execute os testes de integração com:

```bash
./vendor/bin/sail artisan test
```

Se tudo estiver configurado corretamente, você verá a saída dos testes no terminal semelhante à imagem abaixo:
<p align="center">
  <img src="public/tests.png" alt="Testes" height="300">
</p>

## Gerando Documentação 📄
```bash
./vendor/bin/sail php artisan l5-swagger:generate
```

Se tiver ocorrido tudo bem, a documentação estará disponível em `http://localhost/api/documentation`. E você verá algo semelhante à imagem abaixo:
<p align="center">
  <img src="public/swagger.png" alt="Swagger" height="300">
</p>

## Acessando a Aplicação 🌐

A API estará acessível através do `http://localhost:80`.


## Possíveis Erros e Soluções 🛠️

- **Erro**: Porta `3306` já está em uso 🚫.
  - **Solução**: Verifique se nenhum outro serviço está usando a porta `3306`. Se necessário, ajuste a porta no seu arquivo `.env` e `docker-compose.yml`.

- **Erro**: Permissões ao executar o Sail ⚠️.
  - **Solução**: Execute os comandos do Sail com `sudo` ou adicione seu usuário ao grupo Docker.

## Contribuindo 🤝

Sinta-se à vontade para contribuir com o projeto. Abra uma issue ou envie um pull request com suas sugestões e melhorias.

## Licença 📝

Este projeto está licenciado sob a [Licença MIT](LICENSE).
