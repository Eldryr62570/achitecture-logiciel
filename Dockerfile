# Utilisez une image PHP-FPM de la version souhaitée
FROM php:8-fpm

# Définit le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Copie tous les fichiers dans le répertoire de travail du conteneur
COPY . /var/www/html/

# Install Composer
RUN apt-get update && apt-get install -y \
    zip \
    unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installe le pilote PostgreSQL pour PDO
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Expose le port 8080 utilisé par PHP-FPM
EXPOSE 8080
# EXPOSE le port 5050 pour pgadmin
EXPOSE 5050

# Commande pour démarrer PHP-FPM
CMD ["php-fpm"]
