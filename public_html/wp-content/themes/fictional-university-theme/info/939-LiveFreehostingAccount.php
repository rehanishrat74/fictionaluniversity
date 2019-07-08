goto wordpress.org -> hosting
    choose siteground
url: learnwebcode.com/student-hosting


https://wordpress.org/plugins/all-in-one-wp-migration/ // for automated deployment.z
All-in-One WP Migration -> Export -> File //it will create one plugin.
after importing, save permalink twice to remove cache.


https://wordpress.org/plugins/wp-migrate-db/
by delicious brains.    // for mysql deployment.


tools -> migrate DB
Find: //fictional-university-dev      //local domain
Replace //brads.sgedu.site            //live domain

delete the second row for new file path.
click on Export.  // we have a new database file in exported format.

create a new dabase in live server using mysqldatabases.
and import the generated file from cpanel->phpmyadmin


/public_html/wp-config.php contains the userids and passwords.

if(file_exists(dirname(__FILE__).'/local.php')){
  //PUT LOCAL CREDENTIALS HERE
} else {
  //PUT LIVE CREDENTIALS HERE.
}
note: donot upload local.php over live servers. this way the wp-config.php will work over both live and local.

update the secret keys by visiting
https://api.wordpress.org/secret-key/1.1/salt/ and update the wp-config.php file.
