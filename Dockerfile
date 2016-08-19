FROM php

RUN apt update
RUN apt upgrade -y
RUN apt install -y python-software-properties
RUN apt install -y software-properties-common
RUN apt-add-repository -y ppa:ondrej/php
RUN apt update
RUN apt install -y php7.0-zip

ADD  index.php /var/www/
ADD  download.php /var/www/
ADD  com.php /var/www/
ADD  info.php /var/www/

EXPOSE 8080
WORKDIR /var/www/

ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]
