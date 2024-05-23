# Use the official PHP image as base
FROM php:8.3-apache

# Set working directory
WORKDIR /var/www/html

# Copy project files into the container
COPY . /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install necessary PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Expose port 80
EXPOSE 80

# Start Apache server in the foreground
CMD ["apache2-foreground"]
