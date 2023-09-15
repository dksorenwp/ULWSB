#!/bin/bash

# Display ASCII banner
echo -e "\n\n\e[36m _    _ _ __          _______ ____  "
echo -e "| |  | | |\ \        / / ____|  _ \ "
echo -e "| |  | | | \ \  /\  / / (___ | |_) |"
echo -e "| |  | | |  \ \/  \/ / \___ \|  _ < "
echo -e "| |__| | |___\  /\  /  ____) | |_) |"
echo -e " \____/|______\/  \/  |_____/|____/ "
echo -e "\e[31m                       BETA"
echo -e "\e[0m\n"

# Step 1: Update package list
echo -e "\e[32mUpdating package list...\e[0m"
sudo apt update
if [ $? -eq 0 ]; then
    echo -e "\e[32mCompleted: Updated package list\e[0m"
else
    echo -e "\e[31mFailed: Updated package list\e[0m"
    exit 1
fi

# Install packages
packages=("nginx" "php-fpm" "ffmpeg" "git")  # Replace "php-fpm" with "php8.2-fpm"
for package in "${packages[@]}"; do
    if dpkg -l | grep -q $package; then
        echo -e "\e[33mWarning: $package is already installed. If you encounter any issues, it is recommended to uninstall it and run this installation again\e[0m"
    else
        echo -e "\e[32mInstalling $package...\e[0m"
        sudo apt-get install -y $package
        if [ $? -eq 0 ]; then
            echo -e "\e[32mCompleted: Installed $package\e[0m"
        else
            echo -e "\e[Failed: Installed $package\e[0m"
            exit 1
        fi
    fi
done

# Enable Nginx to start on boot
echo -e "\e[32mEnabling Nginx to start on boot...\e[0m"
sudo systemctl enable nginx
if [ $? -eq 0 ]; then
    echo -e "\e[32mCompleted: Nginx enabled to start on boot\e[0m"
else
    echo -e "\e[31mFailed: Unable to enable Nginx to start on boot\e[0m"
    exit 1
fi

# Get the PHP version
PHP_VERSION=$(php -v | grep -oP 'PHP \K[0-9]+\.[0-9]+')
if [ -z "$PHP_VERSION" ]; then
    echo -e "\e[31mFailed to detect PHP version. Please check your PHP installation.\e[0m"
    exit 1
fi

# Update the Nginx configuration file with the PHP version
echo -e "\e[32mUpdating Nginx configuration with PHP $PHP_VERSION...\e[0m"
NGINX_CONFIG="/etc/nginx/sites-available/default"
PHP_FPM_SOCK="/var/run/php/php${PHP_VERSION}-fpm.sock"

# Backup the original Nginx configuration file
sudo cp "$NGINX_CONFIG" "$NGINX_CONFIG.backup"

# Update the Nginx configuration
sudo sed -i "s|fastcgi_pass unix:/var/run/php/php%version%-fpm.sock;|fastcgi_pass unix:$PHP_FPM_SOCK;|g" "$NGINX_CONFIG"

# Test Nginx configuration and reload Nginx
sudo nginx -t
if [ $? -eq 0 ]; then
    sudo systemctl reload nginx
    echo -e "\e[32mNginx configuration updated successfully\e[0m"
else
    echo -e "\e[31mFailed to update Nginx configuration\e[0m"
    exit 1
fi

# Additional setup steps for webui can be added here

echo -e "\e[32mSetup completed successfully!\e[0m"