FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
	libfreetype6-dev \
	libjpeg62-turbo-dev \
	libpng-dev \
	libonig-dev \
	libzip-dev \
	zip \
	unzip \
	&& rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd mbstring zip pdo_mysql mysqli

# Optional: Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

EXPOSE 9000
CMD ["php-fpm"]

