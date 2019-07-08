<?php

to install gulp, see 913-workflow automation stepbystep.php



Note on Gulp
Section 7, Lecture 24
Some of you will run into technical difficulties in the following lesson when I ask you to install "Gulp" globally. If you do, don't worry, it is not absolutely vital that you install Gulp globally.

If you are unable to install Gulp globally just know that later in the course when I tell you to run commands like gulp watch  or gulp styles  or gulp scripts  you can instead simply run npm run gulpwatch  and npm run gulpstyles  and npm run gulpscripts  respectively.

To recap, if you are unable to install Gulp globally, relax, knowing that you can use:

npm run gulpwatch  instead of gulp watch

npm run gulpstyles  instead of gulp styles

npm run gulpscripts  instead of gulp scripts

Thanks!
Brad
-----------------------------------------------------------




sudo apt install nodejs
sudo apt install npm //node package manager.
npm -v
------------npm known issues------------------------------
Normal installation would be sudo apt install nodejs to install Node.js and then sudo apt install npm to install Node Package Manager. However, upon doing so, npm -v says 3.5.2. To upgrade normally, I would do sudo npm install -g npm, which updates to the latest version (which, at the time of writing this article, is 6.0.1).

When I do a which npm, I get /usr/local/bin/npm, however apt installs a symlink at /usr/bin/npm. If I sudo apt purge npm to remove npm, it still leaves the npm version of npm at /usr/local/bin/npm, however npm -v says -bash: /usr/bin/npm: No such file or directory.
https://askubuntu.com/questions/1036278/npm-is-incorrect-version-on-latest-ubuntu-18-04-installation
++++++++++++++++++++++++++++++
answer: The way I found is to purge npm through sudo apt purge npm, then simply recreate a symlink to the global installation via ln -s /usr/local/bin/npm /usr/bin/npm. After that fix, npm -v returns 6.0.1 as expected.


------------------------------------------

https://askubuntu.com/questions/713851/how-to-install-gulp-globally-in-current-project

------------------------------------------
remove gulp
npm ls -g --depth=0  => [/usr/local/lib└── gulp@3.9.1]
npm uninstall -g gulp

$npm ls graceful-fs --gives error code 1.
npm WARN deprecated graceful-fs@3.0.11: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js
    -->   fixex before installing gulp:
    sudo npm install -g graceful-fs graceful-fs@latest-version (min is graceful-fs@4.1.11)
    npm install --save-dev gulp-dependencies-changed
    $ sudo npm install npm@latest -g
    npm update --no-optional

    npm install -g gulp-node-sass
    npm install gulp-node-sass

    npm install -D babel-loader @babel/core @babel/preset-env webpack
    https://www.npmjs.com/package/babel-loader


    https://www.npmjs.com/package/chokidar
    sudo npm install chokidar

    finally sudo apt install gulp
    sudo npm install gulp-cli -g

rehan@xenial ~ $ sudo npm install --global gulp
npm WARN deprecated gulp-util@3.0.8: gulp-util is deprecated - replace it, following the guidelines at https://medium.com/gulpjs/gulp-util-ca3b1f9f9ac5 (not required.)


npm WARN deprecated minimatch@2.0.10: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm -v minimatch => 3.5.2
sudo npm i -g minimatch@3.0.2 //so not reqd to install

I think, you have installed minimatch version 3.0.2 successfully. Its warning only not an error. And you can work with your project. If you are not satisfied then first uninstall minimatch and again install it.
$ sudo npm uninstall -g minimatch
$ sudo npm i -g minimatch@3.0.2  ($ sudo npm i -g minimatch@3.5.2)
or upgrade your npm version to latest
$ sudo npm install npm@latest -g
(# "npm install -g minimatch@3.0.2")





npm WARN deprecated minimatch@0.2.14: Please update to minimatch 3.0.2 or higher to avoid a RegExp DoS issue
npm WARN deprecated graceful-fs@1.2.3: please upgrade to graceful-fs 4 for compatibility with current and future versions of Node.js
/usr/local/bin/gulp -> /usr/local/lib/node_modules/gulp/bin/gulp.js
/usr/local/lib
└─┬ gulp@3.9.1
  ├── archy@1.0.0
  ├─┬ chalk@1.1.3
  │ ├── ansi-styles@2.2.1
  │ ├── escape-string-regexp@1.0.5
  │ ├─┬ has-ansi@2.0.0
  │ │ └── ansi-regex@2.1.1
  │ ├── strip-ansi@3.0.1
  │ └── supports-color@2.0.0
  ├── deprecated@0.0.1
  ├─┬ gulp-util@3.0.8
  │ ├── array-differ@1.0.0
  │ ├── array-uniq@1.0.3
  │ ├── beeper@1.1.1
  │ ├── dateformat@2.2.0
  │ ├─┬ fancy-log@1.3.2
  │ │ ├─┬ ansi-gray@0.1.1
  │ │ │ └── ansi-wrap@0.1.0
  │ │ ├── color-support@1.1.3
  │ │ └── time-stamp@1.1.0
  │ ├─┬ gulplog@1.0.0
  │ │ └── glogg@1.0.1
  │ ├─┬ has-gulplog@0.1.0
  │ │ └── sparkles@1.0.1
  │ ├── lodash._reescape@3.0.0
  │ ├── lodash._reevaluate@3.0.0
  │ ├── lodash._reinterpolate@3.0.0
  │ ├─┬ lodash.template@3.6.2
  │ │ ├── lodash._basecopy@3.0.1
  │ │ ├── lodash._basetostring@3.0.1
  │ │ ├── lodash._basevalues@3.0.0
  │ │ ├── lodash._isiterateecall@3.0.9
  │ │ ├─┬ lodash.escape@3.2.0
  │ │ │ └── lodash._root@3.0.1
  │ │ ├─┬ lodash.keys@3.1.2
  │ │ │ ├── lodash._getnative@3.9.1
  │ │ │ ├── lodash.isarguments@3.1.0
  │ │ │ └── lodash.isarray@3.0.4
  │ │ ├── lodash.restparam@3.6.1
  │ │ └── lodash.templatesettings@3.1.1
  │ ├─┬ multipipe@0.1.2
  │ │ └─┬ duplexer2@0.0.2
  │ │   └── readable-stream@1.1.14
  │ ├── object-assign@3.0.0
  │ ├── replace-ext@0.0.1
  │ ├─┬ through2@2.0.3
  │ │ ├─┬ readable-stream@2.3.6
  │ │ │ ├── core-util-is@1.0.2
  │ │ │ ├── inherits@2.0.3
  │ │ │ ├── isarray@1.0.0
  │ │ │ ├── process-nextick-args@2.0.0
  │ │ │ ├── safe-buffer@5.1.2
  │ │ │ ├── string_decoder@1.1.1
  │ │ │ └── util-deprecate@1.0.2
  │ │ └── xtend@4.0.1
  │ └─┬ vinyl@0.5.3
  │   ├── clone@1.0.4
  │   └── clone-stats@0.0.1
  ├── interpret@1.1.0
  ├─┬ liftoff@2.5.0
  │ ├── extend@3.0.2
  │ ├─┬ findup-sync@2.0.0
  │ │ ├── detect-file@1.0.0
  │ │ ├─┬ is-glob@3.1.0
  │ │ │ └── is-extglob@2.1.1
  │ │ ├─┬ micromatch@3.1.10
  │ │ │ ├── arr-diff@4.0.0
  │ │ │ ├── array-unique@0.3.2
  │ │ │ ├─┬ braces@2.3.2
  │ │ │ │ ├── arr-flatten@1.1.0
  │ │ │ │ ├─┬ extend-shallow@2.0.1
  │ │ │ │ │ └── is-extendable@0.1.1
  │ │ │ │ ├─┬ fill-range@4.0.0
  │ │ │ │ │ ├── extend-shallow@2.0.1
  │ │ │ │ │ ├─┬ is-number@3.0.0
  │ │ │ │ │ │ └─┬ kind-of@3.2.2
  │ │ │ │ │ │   └── is-buffer@1.1.6
  │ │ │ │ │ ├── repeat-string@1.6.1
  │ │ │ │ │ └── to-regex-range@2.1.1
  │ │ │ │ ├── repeat-element@1.1.3
  │ │ │ │ ├─┬ snapdragon-node@2.1.1
  │ │ │ │ │ ├─┬ define-property@1.0.0
  │ │ │ │ │ │ └─┬ is-descriptor@1.0.2
  │ │ │ │ │ │   ├── is-accessor-descriptor@1.0.0
  │ │ │ │ │ │   └── is-data-descriptor@1.0.0
  │ │ │ │ │ └─┬ snapdragon-util@3.0.1
  │ │ │ │ │   └── kind-of@3.2.2
  │ │ │ │ └── split-string@3.1.0
  │ │ │ ├─┬ define-property@2.0.2
  │ │ │ │ └─┬ is-descriptor@1.0.2
  │ │ │ │   ├── is-accessor-descriptor@1.0.0
  │ │ │ │   └── is-data-descriptor@1.0.0
  │ │ │ ├─┬ extend-shallow@3.0.2
  │ │ │ │ ├── assign-symbols@1.0.0
  │ │ │ │ └── is-extendable@1.0.1
  │ │ │ ├─┬ extglob@2.0.4
  │ │ │ │ ├─┬ define-property@1.0.0
  │ │ │ │ │ └─┬ is-descriptor@1.0.2
  │ │ │ │ │   ├── is-accessor-descriptor@1.0.0
  │ │ │ │ │   └── is-data-descriptor@1.0.0
  │ │ │ │ ├─┬ expand-brackets@2.1.4
  │ │ │ │ │ ├── define-property@0.2.5
  │ │ │ │ │ ├── extend-shallow@2.0.1
  │ │ │ │ │ └── posix-character-classes@0.1.1
  │ │ │ │ └── extend-shallow@2.0.1
  │ │ │ ├── fragment-cache@0.2.1
  │ │ │ ├── kind-of@6.0.2
  │ │ │ ├─┬ nanomatch@1.2.13
  │ │ │ │ └── is-windows@1.0.2
  │ │ │ ├─┬ regex-not@1.0.2
  │ │ │ │ └─┬ safe-regex@1.1.0
  │ │ │ │   └── ret@0.1.15
  │ │ │ ├─┬ snapdragon@0.8.2
  │ │ │ │ ├─┬ base@0.11.2
  │ │ │ │ │ ├─┬ cache-base@1.0.1
  │ │ │ │ │ │ ├─┬ collection-visit@1.0.0
  │ │ │ │ │ │ │ ├── map-visit@1.0.0
  │ │ │ │ │ │ │ └── object-visit@1.0.1
  │ │ │ │ │ │ ├── get-value@2.0.6
  │ │ │ │ │ │ ├─┬ has-value@1.0.0
  │ │ │ │ │ │ │ └─┬ has-values@1.0.0
  │ │ │ │ │ │ │   └── kind-of@4.0.0
  │ │ │ │ │ │ ├─┬ set-value@2.0.0
  │ │ │ │ │ │ │ └── extend-shallow@2.0.1
  │ │ │ │ │ │ ├─┬ to-object-path@0.3.0
  │ │ │ │ │ │ │ └── kind-of@3.2.2
  │ │ │ │ │ │ ├─┬ union-value@1.0.0
  │ │ │ │ │ │ │ └─┬ set-value@0.4.3
  │ │ │ │ │ │ │   └── extend-shallow@2.0.1
  │ │ │ │ │ │ └─┬ unset-value@1.0.0
  │ │ │ │ │ │   └─┬ has-value@0.3.1
  │ │ │ │ │ │     ├── has-values@0.1.4
  │ │ │ │ │ │     └─┬ isobject@2.1.0
  │ │ │ │ │ │       └── isarray@1.0.0
  │ │ │ │ │ ├─┬ class-utils@0.3.6
  │ │ │ │ │ │ ├── arr-union@3.1.0
  │ │ │ │ │ │ ├── define-property@0.2.5
  │ │ │ │ │ │ └─┬ static-extend@0.1.2
  │ │ │ │ │ │   ├── define-property@0.2.5
  │ │ │ │ │ │   └─┬ object-copy@0.1.0
  │ │ │ │ │ │     ├── copy-descriptor@0.1.1
  │ │ │ │ │ │     ├── define-property@0.2.5
  │ │ │ │ │ │     └── kind-of@3.2.2
  │ │ │ │ │ ├── component-emitter@1.2.1
  │ │ │ │ │ ├─┬ define-property@1.0.0
  │ │ │ │ │ │ └─┬ is-descriptor@1.0.2
  │ │ │ │ │ │   ├── is-accessor-descriptor@1.0.0
  │ │ │ │ │ │   └── is-data-descriptor@1.0.0
  │ │ │ │ │ ├─┬ mixin-deep@1.3.1
  │ │ │ │ │ │ └── is-extendable@1.0.1
  │ │ │ │ │ └── pascalcase@0.1.1
  │ │ │ │ ├─┬ debug@2.6.9
  │ │ │ │ │ └── ms@2.0.0
  │ │ │ │ ├─┬ define-property@0.2.5
  │ │ │ │ │ └─┬ is-descriptor@0.1.6
  │ │ │ │ │   ├─┬ is-accessor-descriptor@0.1.6
  │ │ │ │ │   │ └── kind-of@3.2.2
  │ │ │ │ │   ├─┬ is-data-descriptor@0.1.4
  │ │ │ │ │   │ └── kind-of@3.2.2
  │ │ │ │ │   └── kind-of@5.1.0
  │ │ │ │ ├── extend-shallow@2.0.1
  │ │ │ │ ├── source-map@0.5.7
  │ │ │ │ ├─┬ source-map-resolve@0.5.2
  │ │ │ │ │ ├── atob@2.1.2
  │ │ │ │ │ ├── decode-uri-component@0.2.0
  │ │ │ │ │ ├── resolve-url@0.2.1
  │ │ │ │ │ ├── source-map-url@0.4.0
  │ │ │ │ │ └── urix@0.1.0
  │ │ │ │ └── use@3.1.1
  │ │ │ └── to-regex@3.0.2
  │ │ └─┬ resolve-dir@1.0.1
  │ │   └─┬ global-modules@1.0.0
  │ │     └─┬ global-prefix@1.0.2
  │ │       ├── ini@1.3.5
  │ │       └─┬ which@1.3.1
  │ │         └── isexe@2.0.0
  │ ├─┬ fined@1.1.0
  │ │ ├─┬ expand-tilde@2.0.2
  │ │ │ └─┬ homedir-polyfill@1.0.1
  │ │ │   └── parse-passwd@1.0.0
  │ │ ├─┬ object.defaults@1.1.0
  │ │ │ ├── array-each@1.0.1
  │ │ │ └── array-slice@1.1.0
  │ │ ├── object.pick@1.3.0
  │ │ └─┬ parse-filepath@1.0.2
  │ │   ├─┬ is-absolute@1.0.0
  │ │   │ └─┬ is-relative@1.0.0
  │ │   │   └─┬ is-unc-path@1.0.0
  │ │   │     └── unc-path-regex@0.1.2
  │ │   ├── map-cache@0.2.2
  │ │   └─┬ path-root@0.1.1
  │ │     └── path-root-regex@0.1.2
  │ ├── flagged-respawn@1.0.0
  │ ├─┬ is-plain-object@2.0.4
  │ │ └── isobject@3.0.1
  │ ├─┬ object.map@1.0.1
  │ │ ├─┬ for-own@1.0.0
  │ │ │ └── for-in@1.0.2
  │ │ └── make-iterator@1.0.1
  │ ├── rechoir@0.6.2
  │ └─┬ resolve@1.8.1
  │   └── path-parse@1.0.6
  ├── minimist@1.2.0
  ├─┬ orchestrator@0.3.8
  │ ├─┬ end-of-stream@0.1.5
  │ │ └─┬ once@1.3.3
  │ │   └── wrappy@1.0.2
  │ ├── sequencify@0.0.7
  │ └── stream-consume@0.1.1
  ├── pretty-hrtime@1.0.3
  ├── semver@4.3.6
  ├─┬ tildify@1.2.0
  │ └── os-homedir@1.0.2
  ├─┬ v8flags@2.1.1
  │ └── user-home@1.1.1
  └─┬ vinyl-fs@0.3.14
    ├── defaults@1.0.3
    ├─┬ glob-stream@3.1.18
    │ ├─┬ glob@4.5.3
    │ │ └── inflight@1.0.6
    │ ├─┬ glob2base@0.0.12
    │ │ └── find-index@0.1.1
    │ ├─┬ minimatch@2.0.10
    │ │ └─┬ brace-expansion@1.1.11
    │ │   ├── balanced-match@1.0.0
    │ │   └── concat-map@0.0.1
    │ ├── ordered-read-streams@0.1.0
    │ ├─┬ through2@0.6.5
    │ │ └── readable-stream@1.0.34
    │ └── unique-stream@1.0.0
    ├─┬ glob-watcher@0.0.6
    │ └─┬ gaze@0.5.2
    │   └─┬ globule@0.1.0
    │     ├─┬ glob@3.1.21
    │     │ ├── graceful-fs@1.2.3
    │     │ └── inherits@1.0.2
    │     ├── lodash@1.0.2
    │     └─┬ minimatch@0.2.14
    │       ├── lru-cache@2.7.3
    │       └── sigmund@1.0.1
    ├─┬ graceful-fs@3.0.11
    │ └── natives@1.1.6
    ├─┬ mkdirp@0.5.1
    │ └── minimist@0.0.8
    ├─┬ strip-bom@1.0.0
    │ ├── first-chunk-stream@1.0.0
    │ └── is-utf8@0.2.1
    ├─┬ through2@0.6.5
    │ └─┬ readable-stream@1.0.34
    │   ├── isarray@0.0.1
    │   └── string_decoder@0.10.31
    └─┬ vinyl@0.4.6
      └── clone@0.2.0



----------------------------------
//command line for winodws. for linux not needed.
git bash
git-scm.com

-----------------------------


?>


