General Information:
--------------------

This is a setup for a TOR based onion shared hosting server similar to what freedom hosting used. I have made
the install basically copy and paste based, so the prerequisite is to install standard ubuntu 16.04 LTS or 17.04
I have tested the install on server / desktop additions, I have not bothered to correct any postfix / Email on this
production, however this is something you can do in your spare time if required. The step by step I have added, will
allow anyone with basic unix knowledge to create a working web-hosting server. The purpose of this project
is to allow anyone to have a functional onion hosting server up and running within a hour.

I would suggest running a copy of clonzilla and backing up your ubuntu installation prior to installing so you can easily
roll back to prior in case things do not got to plan. Totally optional step.

This project is provided as is and before putting it into production you should make your own changes as needed.

Installation Instructions:
--------------------------

The configuration was designed for ubuntu 17.04 desktop 64 bit edition installation, but also works on ubuntu 16.04 LTS server. 
The following commands will install all required packages:


Installation Process:
-----------------------------------------

```
sudo -i
sudo apt-get install software-properties-common
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install nano
sudo apt-get install apt-transport-https lsb-release ca-certificates
sudo apt-get update
sudo apt-get install python-software-properties software-properties-common
sudo LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
sudo apt-get update

Optional - Remove Apache2 to prevent any conflicts
sudo sudo service apache2 stop
sudo apt-get remove apache2*
sudo apt-get autoremove
sudo apt-get purge apache2*

Install main services first
-----------------------------
sudo apt-get install mariadb-server

sudo apt-get --no-install-recommends install apt-transport-tor aspell curl dovecot-imapd dovecot-pop3d git haveged hunspell iptables locales-all logrotate

sudo apt-get --no-install-recommends install nginx-light postfix postfix-mysql 

Accept default internet site settings for mail and proceed to installing php

Install php next
-----------------
sudo apt-get --no-install-recommends install php7.0-bcmath php7.0-bz2 php7.0-curl php7.0-dba php7.0-enchant php7.0-fpm php7.0-gd php7.0-gmp php7.0-imap php7.0-json php7.0-mbstring php7.0-mcrypt php7.0-mysql php7.0-opcache php7.0-pspell php7.0-readline php7.0-recode php7.0-soap php7.0-sqlite3 php7.0-tidy php7.0-xml php7.0-xmlrpc php7.0-xsl php7.0-zip php7.1-bcmath php7.1-bz2 php7.1-cli php7.1-curl php7.1-dba php7.1-enchant php7.1-fpm php7.1-gd php7.1-gmp php7.1-imap php7.1-intl php7.1-json php7.1-mbstring php7.1-mcrypt php7.1-mysql php7.1-opcache php7.1-pspell php7.1-pspell php7.1-readline php7.1-recode php7.1-soap php7.1-sqlite3 php7.1-tidy php7.1-xml php7.1-xmlrpc php7.1-xsl php7.1-zip 

Install other packages
----------------------

sudo apt-get --no-install-recommends install phpmyadmin php-imagick sasl2-bin ssh subversion tor vsftpd 

Do not select any webserver to configure!	
Use default server password for myphpadmin when setting up, (your server root password!)
-----------------------------------------------------------------------------------------
sudo apt-get --no-install-recommends install adminer
cd /root
wget https://github.com/WoWzee/tor-hosting/archive/master.zip
sudo apt-get install zip
unzip master.zip
cd tor-hosting-master

You now need to create a unique .onion vanity url
--------------------------------------------------

1.) Use eschalot to create the private key and .onion then use the .onion address
that was just created to amend the find examples that follow later.

wget https://github.com/ReclaimYourPrivacy/eschalot/archive/master.zip
unzip master.zip
mv eschalot-master esch
apt install gcc
apt-get install make
apt-get install openssl
apt-get install libcurl4-openssl-dev
apt-get install libssl-dev
cd esch
make
./eschalot -vct6 -r yourhost > yourhost.txt



2.) Sign up with noip.me and get a free dynamic address to use for your .ddns.net address in the the following.

3.) Sign up and login in to noip.me and set the new dynamic host you created to match your server ip / ubuntu machine


Quick dirty way to edit all the files instead of manually sifting through them all is as follows:
--------------------------------------------------------------------------------------------------

Go to your tor-hosting-master folder in your home directory

make sure you have already issued the sudo -i command and are in the tor-hosting-master directory

Then run the find commands as per examples but change them to your own names and onions like my examples.

EXAMPLES OF HOW THEY SHOULD LOOK WHEN EDITED DO NOT RUN!!!!
find ./ -type f -readable -writable -exec sed -i "s/hosting2271.ddns.net/hosting1171.ddns.net/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/torhostxjah7oso6.onion/torhostxjah7r634.onion/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/TorHost's/MyHost's/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/torhostxjah7oso6.onion/torhostxjah7r634.onion/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/TorHost/myHosting/g" {} \;
EXAMPLES OF HOW THEY SHOULD LOOK WHEN EDITED DO NOT RUN!!!!


HERE ARE THE ONES TO RUN ONCE YOU EDIT THEM!

find ./ -type f -readable -writable -exec sed -i "s/hosting2271.ddns.net/CHANGE-THIS-TO-YOUR-OWN-ADDRESS/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/torhostxjah7oso6.onion/CHANGE-THIS-TO-YOUR-OWN-ONION/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/TorHost's/CHANGE-THIS-TO-YOUR-OWN-NAME/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/torhostxjah7oso6.onion/CHANGE-THIS-TO-YOUR-OWN-ONION/g" {} \;
find ./ -type f -readable -writable -exec sed -i "s/TorHost/CHANGE-THIS-TO-YOUR-OWN-NAME/g" {} \;

NOW ZIP THE MODIFIED FILES & COPY THE NEW ZIP FILES TO ROOT / SO YOU CAN EASILY EXTRACT AND OVERWRITE FROM ROOT DIRECTORY
--------------------------------------------------------------------------------------------------------------------------
zip -r etc.zip etc/*
zip -r var.zip var/*
sudo cp var.zip /
sudo cp etc.zip /
cd /



Create a mysql user with all permissions for our hosting management:
--------------------------------------------------------------------
sudo mysql -u root
CREATE USER 'hosting'@'localhost' IDENTIFIED BY 'CHANGE-THIS-TO-YOUR-PASSWORD';
GRANT ALL PRIVILEGES ON *.* TO 'hosting'@'localhost' WITH GRANT OPTION;
quit

Next deploy hosting system. (if you require the optional rc.local & ssh config file move to the directory /etc/)
----------------------------
make sure your still using sudo -i terminal 

sudo unzip etc.zip

use option - All overwite!

sudo unzip var.zip

use option - All overwite!

sudo reboot

Now you have rebooted tor has created a new .onion private key & hostname you can add your own vanity url
by using the details from eschalot and edit the old generic ones private_key and hostname.
--------------------------------------------------------------------------------------------
open terminal
sudo -i
cd /var/lib/tor/hidden_service/
nano hostname
nano private_key
service tor restart

Now run all this from command line as root.
--------------------------------------------
Run terminal as root!
sudo -i
sudo nano /etc/fstab
append to the end of file

tmpfs /tmp tmpfs defaults 0 0
tmpfs /var/log/nginx tmpfs rw,user 0 0

sudo nano /etc/login.defs

append to end of file

SUB_GID_COUNT 1
SUB_UID_COUNT 1

Only if you overwrote it if not skip
------------------------------------
cp /etc/rc.local /root

Restore to default if this file overwrote if not skip!
------------------------------------------------------
nano /etc/rc.local   

overwrite the sshd_config back to defualt otherwise you
will not be able to connect using the one in this archive.
----------------------------------------------
cp /root/sshd_config /etc/ssh/

replace sources.list # if you overwrote if not skip
----------------------------------------------------
cp /root/sources.list /etc/apt/  

As time syncronisation is important, you should configure ntp servers in /etc/systemd/timesyncd.conf and make them match with the entries in /etc/rc.local iptables configuration

To create all required tor and php instances run the following commands:
--------------------------------------------------------------------------
for instance in 2 3 4 5 6 7 a b c d e f g h i j k l m n o p q r s t u v w x y z; do(tor-instance-create $instance) done

for instance in default 2 3 4 5 6 7 a b c d e f g h i j k l m n o p q r s t u v w x y z; do(systemctl enable php7.0-fpm@$instance; systemctl enable php7.1-fpm@$instance;) done

And to get a list of all tor user ids to add in /etc/rc.local run the following:
---------------------------------------------------------------------------------
for instance in 2 3 4 5 6 7 a b c d e f g h i j k l m n o p q r s t u v w x y z; do(id "_tor-$instance") done && id debian-tor

Install squirrelmail for web based mail management grab the latest squirrelmail and install it in /var/www/html/squirrelmail:
---------------------------------------------------------------------------------------------------------
cd /var/www/html/ && svn checkout https://svn.code.sf.net/p/squirrelmail/code/trunk/squirrelmail && cd squirrelmail && ./configure


NOW EDIT THE MAIN COMMON.PHP
-----------------------------
cd /var/www
nano common.php

Edit password only as this is all you really need to do.


Now run the setup script
-------------------------
sudo php /var/www/setup.php

Enable systemd timers to regularly run various managing tasks:
--------------------------------------------------------------
ln -s /etc/systemd/system/hosting-del.timer /etc/systemd/system/multi-user.target.wants/hosting-del.timer
ln -s /etc/systemd/system/hosting.timer /etc/systemd/system/multi-user.target.wants/hosting.timer

Add empty directories that should be copied when creating a new user and set permissions correctly:
---------------------------------------------------------------------------------------------------
mkdir /var/www/skel/data /var/www/skel/Maildir /var/www/skel/tmp
chmod 755 /var/www/skel/data /var/www/skel/Maildir /var/www/skel/tmp /var/www/skel/www

Now you can edit the postfix - mail sections to your own needs or just leave them as if you are not using mail.
see optional steps - Read Me

Reboot server and all should be working.

Remember to open any ports needed for tor & tor instances web server etc.

```
Optional-
----------
If you wish to create a email server on the system follow this guide. 
https://workaround.org/ispmail/wheezy/

Live demo:
----------

If you want to see the setup in action or create your own site on my server, you can visit my [TOR hidden service](http://hosting5afrku32b.onion/).
