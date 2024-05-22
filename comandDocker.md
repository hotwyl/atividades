# curl -s "https://laravel.build/unigameweek?with=mysql,redis,mailhog" | bash
# https://github.com/especializati/setup-docker-laravel
# composer require -W --dev laravel-shift/blueprint
# blueprint:build
# blueprint:erase

curl -s "https://laravel.build/unigameweek?with=mysql,redis,mailhog" | bash;

Para excluir todos os containers em execução utilize:

docker ps –a

docker rm $(docker ps -aq)

docker stop $(docker ps -qa)

docker container ls

docker image ls

docker volume ls

Remover volumes pendentes:

docker volume prune

docker container -a
