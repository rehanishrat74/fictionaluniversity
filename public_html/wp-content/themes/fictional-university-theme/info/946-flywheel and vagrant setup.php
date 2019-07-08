steps to have https over local as .dev is owned by google. it gives error as chrome is also owned by google. it displays message that your connection is not private.

local by flywheel steps.
1. stop site in local by flywheel.
2. top horizontal menue, click on ssl
3. click on trust button and provide your existing userid and pwd.


vagrant steps:
---------------
1. vagrant up.
2. it is recommended to use .test domain instead of .dev.

PuPHPet. PuPHPet is an online configuration tool that helps you configure a Vagrant project. You work through a form on the website, selecting options for your site, and then download a package containing a Vagrantfile and other scripts to set up a virtual machine. puphpet.com

3. open puphpet .config.yaml file and edit following as
4. vhosts:
      servername: fictional-university.test
      serveraliases:
              - www.fictional-univeristy.test.
5. vagrant provision.
6. edit host /etc/file as
  192.168.56.101 fictional-university.dev pets.dev finctional-university.test
7. in functions.php , update domain name in database as.
    update_option('siteurl','http://fictional-university.test');
    update_option('home','http://fictional-university.test');
8. visit fictional-university.test/wp-login.php
9. got to settings.permalink.save
10.
11. in var/www/settings.js/ update
    themeLocation = '/var/www/amazingcollege/public_html/wp-content/themes/fictional-university-theme/';
    exports.urlToPreview = 'http://amazingcollege.test/';



for private browsing:
Click on Chrome's main menu button, represented by three vertically placed dots and located in the upper right corner of the browser window. When the drop-down menu appears, select the choice labeled New Incognito Window.


www.virtualbox.org
www.vagrantup.com
www.puphpet.com
