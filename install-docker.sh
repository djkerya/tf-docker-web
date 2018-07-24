#!/bin/bash
sudo apt -y update ; \
sleep 30
#DEBIAN_FRONTEND=noninteractive DEBIAN_PRIORITY=critical \
sudo apt -y install \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common \
    aptdaemon \
    jq ; \
sleep 10 ; \
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add - ; \
sleep 5 ; \
sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable" ; \
sleep 5 ;
#sudo aptdcon -y update ; \
#sleep 40; \
sudo aptdcon -c ; sleep 30 ; \
sudo aptdcon -i docker-ce ; sleep 5 ; \
apt -y install docker-ce  ; sleep 5

sudo service docker restart ; echo 'docker restart' ; \
sleep 10 ; \
sudo chmod 777 /var/run/docker.sock ; \
#sleep 30 ; \
echo 'upgrade'
#DEBIAN_FRONTEND=noninteractive DEBIAN_PRIORITY=critical \
#sudo apt-get -qq -y -o "Dpkg::Options::=--force-confdef" -o "Dpkg::Options::=--force-confold" upgrade ; \
sudo apt -y upgrade

mkdir -p /home/ubuntu/www/
cd /tmp/
touch /tmp/docker-compose.yml

cat <<EOT >> /tmp/docker-compose.yml
version: '3'

services:
 web:
    image: nginx:latest
    ports:
    - "80:80"
    volumes:
    - /home/ubuntu/www:/usr/share/nginx/html:ro
    - ./www:/www
    - /home/ubuntu/nginx.conf:/etc/nginx/nginx.conf
    links:
    - php
 php:
    image: php:7-fpm
 www:
    image: 127.0.0.1:5000/www
    build: ./www/

EOT

cp /tmp/docker-compose.yml /home/ubuntu/

sudo curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/bin/docker-compose
sudo chmod +x /usr/bin/docker-compose
sudo docker-compose up -d
