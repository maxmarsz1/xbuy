FROM php:8.1-fpm

# Install PostgreSQL client libraries and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Disable opcache for development
RUN echo "opcache.enable=0" > /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini


# Set working directory
WORKDIR /var/www/html

# Expose the port
EXPOSE 9000