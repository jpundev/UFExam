# Use the Gitpod full environment as the base
FROM gitpod/workspace-full
FROM php:7.4-fpm
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo pdo_mysql

# Install MySQL client for CLI database access
USER root
RUN apt-get update && apt-get install -y mysql-client && apt-get clean && rm -rf /var/cache/apt/* && rm -rf /var/lib/apt/lists/* && rm -rf /tmp/*
# Set up default config file for CLI to connect to the project DB
RUN echo "[mysql]" > /etc/mysql/conf.d/mysql.cnf
RUN echo "host=0.0.0.0" >> /etc/mysql/conf.d/mysql.cnf
RUN echo "user=uberflip" >> /etc/mysql/conf.d/mysql.cnf
RUN echo "password=pass123" >> /etc/mysql/conf.d/mysql.cnf
RUN echo "database=university" >> /etc/mysql/conf.d/mysql.cnf


# Install the newest version of Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Set up Sail alias, even if they don't choose Laravel, then this image can be reused
RUN echo "alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'" >> ~/.bashrc
# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]