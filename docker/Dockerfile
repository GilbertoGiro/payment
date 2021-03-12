FROM ubuntu:20.04

# Apply noninteractive for "tzdata" package
ARG DEBIAN_FRONTEND=noninteractive

# Define default workdir
WORKDIR /opt/payment

# Update ubuntu packages list and install necessary packages
RUN apt-get -y update && \
    apt-get -y install php7.4 php7.4-xml php7.4-mbstring php7.4-zip \
    php7.4-mysql php-fpm supervisor nginx tzdata curl zip unzip vim

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

# Remove PHP-FPM daemon
RUN sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.4/fpm/php-fpm.conf

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
ARG permission_paths='/opt/payment /var/log /tmp'

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
