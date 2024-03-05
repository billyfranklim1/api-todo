# Todo



## Pré-requisitos ✅


**Importante:** Laravel Sail utiliza a porta `3306` para o MySQL por padrão. Certifique-se de que esta porta esteja disponível 🚦 ou ajuste a configuração conforme necessário.


## Como Clonar o Projeto 📋

Para clonar o projeto, abra um terminal e execute o seguinte comando:

```bash
git clone
```

🎉 Após clonar o repositório, entre no diretório do projeto:

```bash
cd 
```

## Configuração Inicial 🔧

Copie o arquivo `.env.example` para `.env` para configurar o ambiente:

```bash
cp .env.example .env
```

Inicie os contêineres Docker com Laravel Sail 🐳:

```bash
./vendor/bin/sail up --build
```

Instale as dependências do projeto:

```bash
./vendor/bin/sail composer install
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
  <img src="" alt="Testes de Integração" />
</p>



## Acessando a Aplicação 🌐

A API estará acessível através do `http://localhost:80`.

Se tudo estiver configurado corretamente, você verá a página inicial como a imagem abaixo:
<p align="center">
  <img src="" alt="Página Inicial" />
</p>

## Possíveis Erros e Soluções 🛠️

- **Erro**: Porta `3306` já está em uso 🚫.
  - **Solução**: Verifique se nenhum outro serviço está usando a porta `3306`. Se necessário, ajuste a porta no seu arquivo `.env` e `docker-compose.yml`.

- **Erro**: Permissões ao executar o Sail ⚠️.
  - **Solução**: Execute os comandos do Sail com `sudo` ou adicione seu usuário ao grupo Docker.

## Contribuindo 🤝

Sinta-se à vontade para contribuir com o projeto. Abra uma issue ou envie um pull request com suas sugestões e melhorias.

## Licença 📝

Este projeto está licenciado sob a [Licença MIT](LICENSE).
