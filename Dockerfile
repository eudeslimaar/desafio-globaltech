FROM php:8.2-apache

# Instalar extensões necessárias
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Ativar mod_rewrite para URLs amigáveis
RUN a2enmod rewrite

# Copiar o Composer para o contêiner
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar composer.json e instalar dependências
COPY composer.json ./
RUN composer install --no-dev --optimize-autoloader

# Copiar o código-fonte para o contêiner
COPY . /var/www/html/

# Ajustar permissões dos arquivos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expor a porta 80
EXPOSE 80

# Iniciar o Apache
CMD ["apache2-foreground"]
