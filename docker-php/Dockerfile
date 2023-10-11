# !php ใช้ version 8.2 สามารถเปลี่ยนได้ตามที่เราต้องการแต่ต้องเป็นตัว fpm นะครับ เพื่อที่จะให้กับ nginx
FROM php:8.2-fpm-buster

# !Install คำสั่งสำหรับการลง package ที่ laravel required ไว้นะครับ
RUN apt-get update \
  && apt-get install -y \
    nano \
    cron \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libmcrypt-dev \    
    libxslt1-dev \
    openssh-server \
    openssh-client \
    zlib1g-dev \
    libzip-dev \    
    unzip \
    rsync \
    nodejs \
    apt-get clean && rm -rf /var/lib/apt/lists/* \
    a2enmod rewrite     

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www


#&& docker-php-ext-enable pdo_mysql \