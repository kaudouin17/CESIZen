# ---- 1) Étape Composer (Alpine) ----
FROM composer:2 AS vendor

ARG COMPOSER_DEV=false
ENV COMPOSER_ALLOW_SUPERUSER=1

# Installer intl sur Alpine (nécessite icu-dev + outils de build)
RUN apk add --no-cache icu-dev git unzip $PHPIZE_DEPS \
 && docker-php-ext-configure intl \
 && docker-php-ext-install intl

WORKDIR /app
# Optimise le cache : copier d’abord composer.*
COPY composer.json composer.lock* ./

# Installer les dépendances
RUN if [ "$COMPOSER_DEV" = "true" ]; then \
      composer install --prefer-dist --no-interaction --no-progress; \
    else \
      composer install --no-dev --prefer-dist --no-interaction --no-progress --optimize-autoloader; \
    fi

# ---- 2) Image finale : PHP + Apache (Debian) ----
FROM php:8.3-apache

# Paquets & extensions nécessaires à l’exécution ih
RUN apt-get update \
 && apt-get install -y --no-install-recommends git unzip libicu-dev libzip-dev curl \
 && docker-php-ext-install intl pdo_mysql zip opcache \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

# VHost: docroot sur /public et AllowOverride pour .htaccess
RUN set -eux; \
  printf '%s\n' \
  '<VirtualHost *:80>' \
  '  DocumentRoot /var/www/html/public' \
  '  <Directory /var/www/html/public>' \
  '    AllowOverride All' \
  '    Require all granted' \
  '  </Directory>' \
  '  ErrorLog ${APACHE_LOG_DIR}/error.log' \
  '  CustomLog ${APACHE_LOG_DIR}/access.log combined' \
  '</VirtualHost>' \
  > /etc/apache2/sites-available/000-default.conf

# OPcache (prod)
RUN set -eux; \
  { \
    echo 'opcache.enable=1'; \
    echo 'opcache.enable_cli=0'; \
    echo 'opcache.memory_consumption=128'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.validate_timestamps=0'; \
  } > /usr/local/etc/php/conf.d/opcache.ini

ENV CI_ENVIRONMENT=production
WORKDIR /var/www/html

# Copier le code et les vendors depuis l’étape Composer
COPY . .
COPY --from=vendor /app/vendor ./vendor

# Droits pour CodeIgniter (writable/)
RUN set -eux; \
  chown -R www-data:www-data /var/www/html; \
  mkdir -p writable; \
  chgrp -R www-data writable || true; \
  find writable -type d -exec chmod 775 {} \; || true; \
  find writable -type f -exec chmod 664 {} \; || true

HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
  CMD curl -fsS http://localhost/ || exit 1

EXPOSE 80
CMD ["apache2-foreground"]
