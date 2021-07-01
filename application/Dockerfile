FROM php:7.4.19-buster
RUN apt-get -y update && apt-get -y upgrade && apt-get -y install wget unzip libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer global require robmorgan/phinx
ENV PATH="${PATH}:/root/.composer/vendor/bin"
WORKDIR /usr/src/app
CMD ["phinx", "--version"]