docker swarm init
docker swarm  join-token manager
docker service create --name registry --publish published=5000,target=5000 registry:2

docker buid .
sudo docker tag bf95b6f5abc8 localhost:5000/www
docker push localhost:5000/www

docker stack deploy  --orchestrator swarm  --compose-file docker-compose.yml www
