# Usamos la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para MySQL y PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el código fuente al contenedor
COPY . /var/www/html/

# Dar permisos de escritura a Apache si es necesario
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 (Apache)
EXPOSE 80

# Opcional: habilitar mod_rewrite de Apache si planeas usar URLs amigables
RUN a2enmod rewrite
