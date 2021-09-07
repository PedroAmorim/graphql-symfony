FROM php:8.0.10-fpm


# basic php extension
RUN docker-php-ext-install pdo_mysql

# Composer require some packages
RUN apt-get update && apt-get install -y \
    vim \
    git \
    wget \
    unzip \
    zsh \
    && rm -rf /var/lib/apt/lists/*

# Xdebug 3
ARG XDEBUG_ENABLED
ARG XDEBUG_IDEKEY
RUN if [ $XDEBUG_ENABLED = true ] ; then \
    pecl install xdebug-3.0.1 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host = 1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey = ${XDEBUG_IDEKEY}" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    ; fi

# Install Symfony Cli
RUN wget https://get.symfony.com/cli/installer -O - | bash \
    && mv /root/.symfony/bin/symfony /usr/local/bin/symfony

# Fix user permission
ARG USER_ID
ARG GROUP_ID
RUN groupadd -f -g $GROUP_ID user \
    && useradd -u $USER_ID -g $GROUP_ID user \
    && mkdir -p /home/user \
    && chown user:user /home/user

USER user

# Install composer with our new User
COPY --from=composer:2.0.9 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/symfony

CMD ["php-fpm"]
