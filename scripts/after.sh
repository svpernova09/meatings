#!/bin/sh

# If you would like to do some extra provisioning you may
# add any commands you wish to this file and they will
# be run after the Homestead machine is provisioned.
echo "Running after.sh"
apt-get -y install phantomjs screen
(crontab -l 2>/dev/null; echo "@reboot    screen -S server -d -m phantomjs --webdriver=4444") | crontab -
echo "Added scree phantomjs to crontab"
screen -S server -d -m phantomjs --webdriver=4444
/usr/local/bin/composer self-update
echo "" >> /home/vagrant/.bashrc
echo "PATH=$PATH:/home/vagrant/meatings.dev/vendor/bin" >> /home/vagrant/.bashrc
echo "export PATH" >> /home/vagrant/.bashrc
echo Done!