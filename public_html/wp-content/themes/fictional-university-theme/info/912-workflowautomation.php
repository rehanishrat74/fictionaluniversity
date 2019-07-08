<?php
workflow automation:
auto refresh browser when save a theme file.
css(sass,less,pstcss) processed autmatically
js to be compiled and bundled autmatically.

all autmaion is done with node.js run javascript outside the scope of webbrowser.
nodejs.org/en

$node --version   //mine is 8.
--------

Npm (node package manager)
----
npm --v   // mine is 3.5.2

Gupl.
------
makes automating tasks very easily
sudo npm install gulp-cli -g

gulp --version  //mine is CLI version 2.0.1
 xxxxxxxxxxxxxxxxxxxxxmine is 3.5.1

-----------------------------------

gulpfile.js
package.json   //list of tools needed.
settings.js
webpack.config.js
download these files from
https://github.com/LearnWebCode/vagrant-lamp

copy above files to /var/www/amazingcollege/public_html directory
goto /var/www/amazingcollege/public_html and type sudo npm install
// this will look package.json and will install corresponding tools


npm WARN deprecated uws@9.14.0: stop using this version
npm WARN deprecated gulp-util@3.0.8: gulp-util is deprecated - replace it, following the guidelines at https://medium.com/gulpjs/gulp-util-ca3b1f9f9ac5
npm WARN deprecated graceful-fs@3.0.11: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js
npm WARN deprecated minimatch@2.0.10: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated minimatch@0.2.14: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated graceful-fs@1.2.3: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js


npm WARN optional Skipping failed optional dependency /chokidar/fsevents:
npm WARN notsup Not compatible with your operating system or architecture: fsevents@1.2.4

npm WARN optional Skipping failed optional dependency /watchpack/chokidar/fsevents:
npm WARN notsup Not compatible with your operating system or architecture: fsevents@1.2.4
npm install -g gulp-node-sass
npm install gulp-node-sass

npm WARN babel-loader@8.0.4 requires a peer of @babel/core@^7.0.0 but none was installed.
npm install -D babel-loader @babel/core @babel/preset-env webpack

npm WARN fictional-university-lwc@1.0.0 No repository field.
----------------------------------------------------------------------



type
in the directory /var/www/amazingcollege/public_html type
gulp watch
// it will open website in browser localhost:3000 and when u do changes in php/css/js files, you can see the immediate effects in the browser without being refreshed.




[Browsersync] Access URLs:
 --------------------------------------
       Local: http://localhost:3000         // this is the url the webbrowser is navigating.
    External: http://192.168.0.109:3000      // this will be url for your ipad/iphone to see the preview..
 --------------------------------------
          UI: http://localhost:3001
 UI External: http://192.168.0.109:3001
 --------------------------------------
 Ctrl+C to exit the gulp watch.


?>



