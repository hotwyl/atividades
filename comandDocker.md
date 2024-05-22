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
