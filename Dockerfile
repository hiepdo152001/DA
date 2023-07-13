FROM php:8.1-fpm

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd pdo_mysql mysqli zip

# RUN useradd -ms /bin/bash hiep98

# RUN chown hiep98:hiep98 /var/www/html

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# install node js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -

RUN apt-get install -y nodejs npm

RUN npm install -g npm@latest

# USER hiep98

WORKDIR /var/www/html
