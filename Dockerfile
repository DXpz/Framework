FROM php:8.2-cli

# Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instalar extensiones adicionales necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libicu-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-install intl zip \
    && apt-get clean

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copiar archivos de composer
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install --no-interaction --no-dev --optimize-autoloader || true

# Copiar el resto de la aplicación
COPY . .

# Asegurar que las dependencias estén instaladas
RUN composer install --no-interaction --optimize-autoloader

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public", "router.php"]

