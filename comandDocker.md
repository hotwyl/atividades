# Arquivo Markdown: Comandos Laravel e Docker
Este arquivo explica o uso de alguns comandos comuns para desenvolvimento com Laravel e Docker.

### Listando Containers Docker (Todos)
~~~
docker ps –a
~~~
- **docker**: Comando para interagir com o Docker.
- **ps**: Subcomando para listar containers.
- **-a**: Flag para mostrar todos os containers, incluindo os parados.

### Removendo Todos os Containers Docker
~~~
docker rm $(docker ps -aq)
~~~
- **docker rm**: Subcomando para remover containers.
- **$(docker ps -aq)**: Comando entre parênteses executado primeiro. Ele exibe IDs de todos os containers em um único argumento (usando `-a` para incluir parados e `-q` para saída silenciosa).
- **$()**: Captura a saída do comando anterior e a utiliza como argumento para `docker rm`.

### Parando Todos os Containers Docker
~~~
docker stop $(docker ps -qa)
~~~
- **docker stop**: Subcomando para parar containers.
- A explicação é similar ao comando anterior, mas utilizando `docker stop` para parar os containers em vez de removê-los.

### Listando Containers Docker (Ativos)
~~~
docker container ls
~~~
**docker container ls**: Subcomando para listar containers ativos (executando).
### Listando Imagens Docker
~~~
docker image ls
~~~
**docker image ls**: Subcomando para listar imagens Docker disponíveis no sistema.

### Listando Volumes Docker
~~~
docker volume ls
~~~
**docker volume ls**: Subcomando para listar volumes Docker (armazenamento persistente).
### Limpando Volumes Docker Não Usados
~~~
docker volume prune
~~~
**docker volume prune**: Subcomando para remover volumes Docker que não estão associados a nenhum container.

### Listando Todos os Containers Docker (Incluindo Parados)
~~~
docker container -a
~~~
**docker container -a**: Subcomando para listar containers (equivalente a `docker ps -a`).

### Criação de Projeto Laravel com Pilha LAMP (MySQL, Redis, Mailhog)
~~~
curl -s "https://laravel.build/meuprojeto?with=mysql,redis,mailhog" | bash
~~~
- **curl**: Comando para transferência de dados pela rede.
- **-s**: Flag para executar o comando silenciosamente (sem saída na tela).
- "https://laravel.build/meuprojeto?with=mysql,redis,mailhog": URL para o serviço Laravel Sail que irá criar um novo projeto Laravel chamado "meuprojeto".
- **?with=mysql,redis,mailhog**: Parâmetros para a criação do projeto, incluindo os serviços MySQL (banco de dados), Redis (cache) e Mailhog (servidor de e-mail para desenvolvimento).
- **| bash**: Envia a saída do comando curl para o interpretador bash, que executa os scripts de configuração do Laravel Sail.

### Criação de Projeto Laravel sem Pilha LAMP
~~~
curl -s "https://laravel.build/meuprojeto" | bash;
~~~

### Instalando Pacote de Desenvolvimento
~~~
composer require -W --dev laravel-shift/blueprint
~~~
- **composer**: Gerenciador de dependências para PHP.
- **require**: Comando para instalar pacotes.
- **-W**: Flag para avisar sobre pacotes obsoletos.
- **--dev**: Flag para instalar o pacote apenas no ambiente de desenvolvimento.
- **laravel-shift/blueprint**: Nome do pacote a ser instalado.

### Executando Blueprint (Build)
~~~
blueprint:build
~~~
Este comando (assumindo que o pacote `laravel-shift/blueprint` está instalado) executa a tarefa de build do Blueprint, que provavelmente gera código, compila assets ou realiza outras tarefas de preparação do projeto.

### Executando Blueprint (Erase)
~~~
blueprint:erase
~~~
Este comando (assumindo que o pacote `laravel-shift/blueprint` está instalado) executa a tarefa de erase do Blueprint, que provavelmente remove arquivos gerados automaticamente ou limpa o diretório de cache.


### Criando um Model:

Utilize o comando `php artisan make:model NomeDoModel`. Isso cria um arquivo de model na pasta `app/Models` com o nome especificado.

### Criando uma Migration:

Utilize o comando `php artisan make:migration create_nome_da_tabela`. Substitua `nome_da_tabela` pelo nome da tabela que você deseja criar no banco de dados. Esse comando cria um arquivo de migration na pasta `database/migrations`.

### Criando um Controller:

Utilize o comando `php artisan make:controller NomeDoController`. Isso cria um arquivo de controller na pasta `app/Http/Controllers` com o nome especificado.

### Criando um Resource Controller (Opcional):

Adicione a flag `-r` ao comando de criação do controller para gerar um resource controller. O comando fica assim: `php artisan make:controller NomeDoController -r`. Um resource controller já possui métodos prontos para as operações CRUD (Create, Read, Update, Delete).

### Criando um Factory (Opcional):

Utilize o comando `php artisan make:factory NomeDoModelFactory`. Isso cria um arquivo de factory na pasta `database/factories` com o nome especificado. Factories são úteis para gerar dados de teste.

### Criando um Seeder (Opcional):

Utilize o comando `php artisan make:seeder NomeDoSeeder`. Isso cria um arquivo de seeder na pasta `database/seeds` com o nome especificado. Seeders são usados para popular o banco de dados com dados iniciais.

### Executando Migrations:

Após criar as migrations, você precisa executá-las para criar as tabelas no banco de dados. Utilize o comando `php artisan migrate`.

### Exemplo Completo:

Para criar um model chamado Produto, uma migration, um controller e um resource controller, utilize os seguintes comandos:
~~~
php artisan make:model Produto
php artisan make:migration create_produtos_table
php artisan make:controller ProdutoController -r
~~~
Observações:

- Você pode usar o flag `-a` ou `--all` em qualquer um dos comandos para criar todos os arquivos de uma só vez (model, migration, factory e resource controller).
- Utilize o flag `--force` para sobrescrever arquivos existentes.

~~~~
php artisan make:model -a Post
php artisan make:controller --all --force ProductController
~~~~

~~~~
php artisan make:controller NomeDoController -r
php artisan make:controller NomeDoController -api
~~~~

/* https://github.com/especializati/setup-docker-laravel */
