FROM php:latest

# APT packages
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    git \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-install zip

# APCU extensions
RUN pecl install apcu && rm -rf /tmp/pear
RUN echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini

## PHP configuration
COPY config/php.ini /usr/local/etc/php/php.ini

# Bash
RUN chsh -s /bin/bash www-data

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Workdir
WORKDIR /var/www/html

# Entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
