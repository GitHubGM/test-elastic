FROM php:8.1-fpm

#ARG user=edige
#ARG uid=1000

RUN apt-get update && apt-get install -y \
      supervisor \
      libpq-dev \
      libpng-dev \
      libjpeg-dev \
      libzip-dev \
      zip unzip \
      git \
      curl \
      gnupg2 \
      libicu-dev \
      g++ \
    && docker-php-ext-install pdo_mysql bcmath gd zip intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

RUN node -v && npm -v
# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#RUN useradd -G www-data,root -u $uid -d /home/$user $user && \
#    mkdir -p /home/$user/.composer && \
#    chown -R $user:$user /home/$user

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./_docker/nginx/conf.d/nginx.conf /etc/nginx/conf.d/nginx.conf

WORKDIR /var/www

#RUN chown -R $user:www-data /var/www && chmod -R 775 /var/www


#USER $user
