# Wordpress-starter-theme-demo
 NSCC Starter Theme Demo based on _s ([underscores](https://underscores.me)). This is not a child theme!

## Pre-Requirements
* Node -> npm
* WP-CLI [see our WP Dev Env setup](https://github.com/redmondmj/Wordpress-dev-demo)
* *AMP Stack [see my WSL LAMP stack](https://github.com/redmondmj/WSL-Lamp)
* Gulp: `npm install --global gulp-cli`


## Download and Install
* you may choose to skip some of this if you have an existing wp install. 
* I'm using wp-cli, but you can manually download and extract the starter theme if you like.
* starting from an empty project folder... here we go!
* WP: `wp core download --path=wp-starter.ca`
* WP-Config: `wp config create --dbname=wpstarter --dbuser=root --prompt=dbpass`
* WP DB: `wp db create`
* Site Install: `wp core install --url=wp-starter.ca --title="NSCC WP Starter Theme" --admin_user=redmondo --admin_password=*kw*5ZI13kmb --admin_email=info@wp-starter.ca`
* Plugin Install: `wp plugin install developer show-current-template --activate`
* note the debug bar... but wheres the debug info?
* enable wp DEBUG in wp-config `define('WP_DEBUG', true);`

## Get _s
* install via wp-cli `wp scaffold _s nscc-theme --theme_name="NSCC Theme" --author="John Doe" --sissify --activate`
* that was easy

## Explore _s
* Style.css theme meta info is partially populated. Needs more info.
* Note minimal CSS, less to get in your way!
* Standard template files are provided based on template hierarchy
* check out SASS and the provided partials
* everything is really well commented!
* review functions.php

## Workflow Setup
* add sample gulp-dev to wp-content/themes ([found in this repo](https://github.com/redmondmj/Wordpress-starter-theme-demo/tree/master/wp-starter.ca/wp-content/themes/gulp-dev))
* edit wp-content/themes/gulp-dev/package.jason to suit your new theme and remove uneccessary info (repo, bugs,homepage, etc.)
* review dependencies and add/remove as needed
    * I removed devdependency versions for this demo
* install `npm install` then fix all the errors :( cause there always is...
    * make sure you don't have the files open in your editor
* review gulpfile.js - edit theme name
    * note the css task for SASS
    * note the image optimizer - just drop your huge images in /RAW/!
    * configure the watcher and browser sync for your dev env.
* run gulp `gulp`

## Basic Theme Editing