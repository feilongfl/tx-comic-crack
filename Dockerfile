FROM php

RUN echo deb http://ppa.launchpad.net/ondrej/php/ubuntu yakkety main  >>/etc/apt/sources.list
RUN echo deb-src http://ppa.launchpad.net/ondrej/php/ubuntu yakkety main  >>/etc/apt/sources.list
RUN apt update
RUN apt install -y php7.0-zip --force-yes

ADD  index.php /var/www/
ADD  download.php /var/www/
ADD  com.php /var/www/
ADD  info.php /var/www/

EXPOSE 8080
WORKDIR /var/www/

ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]
