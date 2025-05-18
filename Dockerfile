ARG COMPOSER_FLAGS='--dev'
FROM php:8.2-fpm-alpine

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
#RUN apt-get update && apt-get install -y \
#    zip \
#    unzip \
#    git \
#    curl

RUN echo "Installing Composer..."
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN echo "Composer installed successfully"

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
