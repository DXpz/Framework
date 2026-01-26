FROM php:8.2-cli

# Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar extensiones adicionales necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libicu-dev \
    curl \
    && docker-php-ext-install intl zip \
    && apt-get clean

WORKDIR /var/www/html

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public", "router.php"]

