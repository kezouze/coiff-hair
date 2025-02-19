FROM php:7.4-apache

# Mettre à jour et installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    nano \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Activation du module rewrite d'Apache
RUN a2enmod rewrite

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement les fichiers utiles pour éviter les conflits
COPY . .

# Changer les permissions des fichiers
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80
