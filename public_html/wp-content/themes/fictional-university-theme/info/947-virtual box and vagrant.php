VirtualBox: Can create a virtual machine on our computer.
Vagrant: Turns a virtual machine into a local dev environment.

Wordpress needs:
Soil (PHP)
Water (Apache)
Sunlight (MySQL)

Vagrant recepie.
https://github.com/LearnWebCode/vagrant-lamp


file:///home/rehan/Downloads/wordpresslectures/vagrant-lamp-master/
Steps:

copy the folder vagrant-lamp-master to desktop and rename to local-sites

//git bash command line is for windows.
https://git-scm.com

//open terminal.
vagrant --version
rehan@xenial ~ $ cd '/home/rehan/Desktop/vagrant-lamp-master'
vagrant up

in the webbrowser, type 193.168.56.101


in the command prompt type
rename vagrant-lamp-master as local-sites.

local-sites$ sudo nano /etc/hosts
192.168.56.101  fictional-university.test

// to halt the vagrant
vagrant halt

download wordpress from wordpress.org and move it to local-sites/fictional-university/app

rename wp-config-sample.php to wp-config.php

create database using localhost/phpmyadmin.

----------------------------------
Create a new folder for the new website.
local-sites/Pets
local-sites/Pets/app

create a new file as
local-sites/Pets/app/index.php

copy n paste the vhosts for new domain name in puphpet/config.yaml.

run vagrant provision
now edit hosts for pets.dev

download worpress to pets/app folder.
vagrant ssh
now we are inside the new server instance.
mysql -u root -p  //password is 123.
you will be in maria db.

mariadb > show databases;
        >create database test123;
        > DROP DATABASE test123;
        >create database pets;
now edit wp-config.php with credentials.

author:
Become a WordPress Developer: Unlocking Power With Code
Created by Brad Schiff
