FROM francarmona/docker-ubuntu16-nginx-php7
MAINTAINER Kerya <kerya@kerya.net>

ENV DEBIAN_FRONTEND noninteractive
ENV DEBIAN_PRIORITY low
ENV LC_ALL C.UTF-8
ENV RUNLEVEL 1
RUN echo exit 0 > /usr/sbin/policy-rc.d
RUN apt-get update &&  apt-get -y install software-properties-common
RUN apt-add-repository -y ppa:ondrej/php
RUN apt-add-repository -y ppa:ondrej/nginx
RUN apt-get purge -y php7.0 php7.0-cli php7.0-fpm php7.0-opcache php7.0-readline
RUN apt-get update && apt-get install -o Dpkg::Options::="--force-confold" -y  nginx php7.2 php7.2-cli php7.2-fpm php7.2-mbstring php7.2-openssl php7.2-curl

ADD config/nginx/nginx.conf /etc/nginx/nginx.conf
ADD config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
ADD ./www /var/www/html
ADD ./logs/ /var/log/
#RUN /etc/init.d/php7.2-fpm restart
#RUN /etc/init.d/nginx restart
CMD /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
EXPOSE 80
