FROM php

ADD  index.php /var/www/
ADD  download.php /var/www/
ADD  com.php /var/www/
EXPOSE 8080
WORKDIR /var/www/

ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]
