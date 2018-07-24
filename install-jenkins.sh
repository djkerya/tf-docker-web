#!/bin/bash
wget -q -O - http://pkg.jenkins-ci.org/debian/jenkins-ci.org.key | sudo apt-key add - ; \
sudo sh -c 'echo deb http://pkg.jenkins-ci.org/debian binary/ > /etc/apt/sources.list.d/jenkins.list' ; \
sudo apt-get -qq update ; \
sleep 10 ; \
sudo apt-get -y -qq install git openjdk-8-jre jenkins ; \
sleep 30
#DEBIAN_FRONTEND=noninteractive DEBIAN_PRIORITY=critical \
#sudo apt-get -y -qq install mysql-client libmysqlclient-dev mysql-server ; \
#sleep 25 ; \
#DEBIAN_FRONTEND=noninteractive DEBIAN_PRIORITY=critical \
#sudo apt-get -qq -y -o "Dpkg::Options::=--force-confdef" -o "Dpkg::Options::=--force-confold" upgrade  ; \
#sleep 10
sudo service jenkins restart

#DEBIAN_FRONTEND=noninteractive sudo apt-get install -qq -y mysql-client libmysqlclient-dev mysql-server ; \
#sleep 5
## Add user to jenkins
## You can check if user was created using: SELECT User FROM mysql.user;
#mysql --user=root --password=root -e \
#sudo mysql -e \
#  "CREATE USER 'jenkins'@'localhost' IDENTIFIED BY 'jenkins';
#   GRANT ALL PRIVILEGES ON * . * TO 'jenkins'@'localhost';
#   FLUSH PRIVILEGES;\q"

# Create sample_database.yml
## BUIL_TAG is a String of "jenkins-${JOB_NAME}-${BUILD_NUMBER}":
##   - JOB_NAME=company-branch
##   - BUILD_NUMBER=99
##   - BUIL_TAG=company-branch-99
sudo mkdir -p /var/lib/jenkins/
sudo chmod 777 /var/lib/jenkins/
sudo touch /var/lib/jenkins/sample_database.yml
sudo chmod 777 /var/lib/jenkins/sample_database.yml

cat <<EOT >> /var/lib/jenkins/sample_database.yml
default: &default
  adapter: mysql2
  username: 'jenkins'
  password: 'jenkins'
  host: 'localhost'
  pool: 100
  encoding: utf8
  reconnect: true
test:
  <<: *default
  database: <%= "sample-test-#{ENV['BUILD_TAG']}" %>
EOT

mkdir -p /home/ubuntu/www/
sudo chmod 777 /home/ubuntu/www/
cd /home/ubuntu/www/
#git init
