<?php
installing gulp
------------------
all automation is done by nodejs.
download LTS version from nodejs.org/en/

//rename the downloaded lts folder.
 mv node-v8.12.0-linux-x64 node

sudo cp -r node/{bin,include,lib,share} /usr/

node -v
v8.12.0

npm -v
6.4.1


$node--vesion

[node installs npm =node package manager.]
$ sudo npm install gulp-cli -g
      [
        /usr/bin/gulp -> /usr/lib/node_modules/gulp-cli/bin/gulp.js
        + gulp-cli@2.0.1
      ]

$ gulp --version => CLI version 2.0.1


Important note:
----------------
*****************************************************
pls donot try to fix warnings. gulp will stop working
*****************************************************

uninstalling gulp
------------------------
 npm uninstall fictional-university-lwc
npm uninstall -D fictional-university-lwc
npm uninstall --save-dev gulp
npm uninstall -g gulp


https://stackoverflow.com/questions/11177954/how-do-i-completely-uninstall-node-js-and-reinstall-from-beginning-mac-os-x
sudo rm -rf /usr/local/{lib/node{,/.npm,_modules},bin,share/man}/{npm*,node*,man1/node*}
sudo rm -rf /usr/local/bin/npm /usr/local/share/man/man1/node* /usr/local/lib/dtrace/node.d ~/.npm ~/.node-gyp

go to /usr/local/lib and delete any node and node_modules
 sudo rm -rf node_modules/

go to /usr/local/include and delete any node and node_modules directory
if you installed with brew install node, then run brew uninstall node in your terminal
check your Home directory for any local or lib or include folders, and delete any node or node_modules from there
delete nodejs from /usr/include

/usr/bin
node-gypxxxxxxxxxxxxxx  nodejsxxxxxxxxxxxxxxxx  nodexxxxxxxxxxxxxxxxxxxx
sudo rm -rf /opt/local/bin/node /opt/local/include/node /opt/local/lib/node_modules


configuring gulp
-------------------
download github.com/LearnWebCode/vagrant-lamp
copy gulpfile.js, package.json,settings.js and webpack.config.js in to the public_html of theme folder.
sudo vi settings.js  and set apropriate folder locations

go to public_html folder and type sudo npm install
edit settings.js file and put appropriate folderlocation and domain name.



usages
running npm ls <promzard> in npm's source tree
npm i npm-install-peers


now type gulp watch or npm run gulpwatch

if you see command line,
  local: http://localhost:3000
  mobile: http://192.168.1.58:3001

------------working with css------------------------
/*
Theme Name: Fictional University
Author: Rehan
Version: 1.0;
*/
copy these contents from style.css into /css/style.css

/css/modules/headlines.css
in &--large
  type color: yellow;
---------------------------------
working with js
js/scriptes-bundled.js   . we used it in functions.php.

in js/scripts.js , type at the end to see if working as
alert("hello. this is a test");





=+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
rehan@xenial /var/www/amazingcollege/public_html $ sudo npm install
npm WARN deprecated gulp-util@3.0.8: gulp-util is deprecated - replace it, following the guidelines at https://medium.com/gulpjs/gulp-util-ca3b1f9f9ac5
npm WARN deprecated graceful-fs@3.0.11: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js
npm WARN deprecated minimatch@2.0.10: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated minimatch@0.2.14: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated graceful-fs@1.2.3: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js
npm WARN deprecated uws@9.14.0: stop using this version
?>
