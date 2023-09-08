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

# Step 1: Install software-properties-common
echo -e "\e[32mInstalling software-properties-common...\e[0m"
sudo apt install -y software-properties-common
if [ $? -eq 0 ]; then
    echo -e "\e[32mCompleted: Installed software-properties-common successfully\e[0m"
else
    echo -e "\e[31mFailed: Installed software-properties-common\e[0m"
    exit 1
fi

# Step 2: Add PHP repository
echo -e "\e[32mAdding PHP repository...\e[0m"
sudo add-apt-repository -y ppa:ondrej/php
if [ $? -eq 0 ]; then
    echo -e "\e[32mCompleted: Added PHP repository\e[0m"
else
    echo -e "\e[31mFailed: Added PHP repository\e[0m"
    exit 1
fi

# Step 3: Update package list
echo -e "\e[32mUpdating package list...\e[0m"
sudo apt update
if [ $? -eq 0 ]; then
    echo -e "\e[32mCompleted: Updated package list\e[0m"
else
    echo -e "\e[31mFailed: Updated package list\e[0m"
    exit 1
fi

# Install packages
packages=("nginx" "php8.1-fpm" "ffmpeg" "git")
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

# Additional setup steps for webui can be added here

echo -e "\e[32mSetup completed successfully!\e[0m"
