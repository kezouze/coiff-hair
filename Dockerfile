FROM php:7.4-apache

# Installation des extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Activation du module rewrite d'Apache
RUN a2enmod rewrite

# Copie des fichiers du projet dans le conteneur
COPY . /var/www/html

# Changement des permissions
RUN chown -R www-data:www-data /var/www/html

# Exposition du port 80
EXPOSE 80
