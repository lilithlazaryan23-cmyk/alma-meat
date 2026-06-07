FROM ubuntu:22.04

ARG NAMESPACE
ARG USER_ID
ARG GROUP_ID
ARG PHP_VERSION
ARG NODE_VERSION
ARG NPM_VERSION

ENV DEBIAN_FRONTEND=noninteractive
ENV LC_ALL=C.UTF-8

WORKDIR /var/www/${NAMESPACE}

COPY . .

RUN apt update && \
    apt full-upgrade -y && \
    apt autoremove -y && \
    apt autoclean

RUN apt install -y software-properties-common apache2 nano curl gnupg unzip

RUN add-apt-repository ppa:ondrej/php && \
    apt install -y php${PHP_VERSION} php${PHP_VERSION}-cli php${PHP_VERSION}-curl php${PHP_VERSION}-zip php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-mysql php${PHP_VERSION}-intl php${PHP_VERSION}-imagick php${PHP_VERSION}-gd php${PHP_VERSION}-bcmath && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - && \
    apt install -y nodejs && \
    npm install -g npm@${NPM_VERSION}

RUN cp /var/www/${NAMESPACE}/docker/apache.conf /etc/apache2/sites-available/ && \
    cd /etc/apache2/sites-available && \
    a2dissite 000-default.conf && \
    a2ensite apache.conf && \
    a2enmod rewrite && \
    service apache2 restart

RUN groupadd -g ${GROUP_ID} ${NAMESPACE} && \
    useradd -u ${USER_ID} -ms /bin/bash -g ${NAMESPACE} ${NAMESPACE} && \
    chown -R ${NAMESPACE}:${NAMESPACE} /var/www/${NAMESPACE} && \
    chmod -R 755 /var/www/${NAMESPACE}

RUN sed -i "s/APACHE_RUN_USER=www-data/APACHE_RUN_USER=${NAMESPACE}/g" /etc/apache2/envvars && \
    sed -i "s/APACHE_RUN_GROUP=www-data/APACHE_RUN_GROUP=${NAMESPACE}/g" /etc/apache2/envvars

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
