FROM francarmona/docker-ubuntu16-nginx-php7
MAINTAINER Kerya <kerya@kerya.net>
ADD config/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./www /var/www/html
#EXPOSE 80
