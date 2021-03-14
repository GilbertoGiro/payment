FROM php:7.4-fpm

# Apply noninteractive for "tzdata" package
ARG DEBIAN_FRONTEND=noninteractive

# Define default workdir
WORKDIR /opt/payment

# Update ubuntu packages list and install necessary packages
RUN apt-get -y update && \
    apt-get -y install libpng-dev libonig-dev libxml2-dev \
    zlib1g-dev supervisor nginx tzdata curl zip unzip vim

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Install Wait script
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/2.8.0/wait /wait
RUN chmod +x /wait

# Set Timezone
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata

# Remove PHP-FPM docker configuration file and daemon
RUN rm /usr/local/etc/php-fpm.d/docker.conf && \
    sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /usr/local/etc/php-fpm.conf

# Remove nginx default files
RUN rm -Rf /etc/nginx/conf.d/* \
    && rm -Rf /etc/nginx/sites-enabled/default \
    && rm -Rf /etc/nginx/sites-available/default

# Apply custom nginx configuration
ADD nginx/nginx.conf /etc/nginx/

# Remove nginx daemon
RUN echo "daemon off;" >> /etc/nginx/nginx.conf

# Apply default nginx configuration
ADD nginx/default.conf /etc/nginx/conf.d/

# Define paths for permissions
ARG permission_paths='/opt/payment /var/log /usr/local/var /tmp'

# Apply custom supervisor file
ADD supervisor/supervisord.conf /etc/supervisor/conf.d/

# Create group and apply for permissions for www-data user
RUN groupadd payment && \
    usermod -a -G payment www-data && \
    chgrp -R payment $permission_paths && \
    chmod -R 774 $permission_paths

# Run supervisor command in background (PHP-FPM and NGINX)
CMD /usr/bin/supervisord -n

# Expose port
EXPOSE 80
