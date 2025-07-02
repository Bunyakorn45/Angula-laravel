FROM php:8.2-cli

# ติดตั้ง dependencies ที่จำเป็น
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpq-dev \
    default-mysql-client

# ติดตั้ง PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# คัดลอกไฟล์ทั้งหมดเข้า container
COPY . .

RUN composer require laravel/passport --no-interaction --no-progress --prefer-dist

# ลบ vendor และ composer.lock เพื่อ clean install
RUN rm -rf vendor composer.lock

# ติดตั้ง dependencies ด้วย Composer
RUN composer install --no-interaction --no-progress --prefer-dist

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000