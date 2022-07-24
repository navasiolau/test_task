FROM php:8.1-fpm

# git, unzip, wget
RUN apt update \
    && apt install -y git unzip wget

# git config
RUN git config --global user.email "mikita.navasiolau@gmail.com" \
    && git config --global user.name "navasiolau"

# Set timezone
RUN rm /etc/localtime \
    && ln -s /usr/share/zoneinfo/Europe/Tbilisi /etc/localtime \
    && "date"

# Install PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
