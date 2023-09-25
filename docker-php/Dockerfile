#php ใช้ version 8.2 สามารถเปลี่ยนได้ตามที่เราต้องการแต่ต้องเป็นตัว fpm นะครับ เพื่อที่จะให้กับ nginx
FROM php:8.2-fpm

# อาร์กิวเมนต์ที่กำหนดไว้ใน docker-compose.yml
ARG user
ARG uid

#Install คำสั่งสำหรับการลง package ที่ laravel required ไว้นะครับ
RUN apt-get update \
  && apt-get install -y \
    cron \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libmcrypt-dev \    
    libxslt1-dev \
    openssh-server \
    openssh-client \
    rsync \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
	  && docker-php-ext-install -j$(nproc) gd
#อันนี้ล้างแคช
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#อันนี้คือ ติดตั้งส่วนขยาย PHP ที่จำเป็นสำหรับ Laravel 
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql \
    && docker-php-ext-install gd && docker-php-ext-enable gd \
    && docker-php-ext-install opcache && docker-php-ext-enable opcache

# สร้างผู้ใช้ระบบเพื่อรันคำสั่ง Composer และ Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# อันนี้ลงเพิ่มเติมคือ composer นั้นเอง เป็นตัว package manager สำหรับการจัดการพวก dependency ของภาษา php ครับ
RUN a2enmod rewrite \
 curl -sS https://getcomposer.org/installer | \
  php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
