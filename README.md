# wordpress-boilerplate
A WordPress setup with functionality and setups that is used over and over in my projects.

## Highlights
These are the main things that you get in this package.

- [Scotch Box](https://box.scotch.io/) - "A Vagrant LAMP Stack That Just Works"
- [Bedrock](https://roots.io/bedrock/) - "WordPress boilerplate with modern development tools, easier configuration, and an improved folder structure."
- [Sage](https://github.com/roots/sage) - The verion that was available on February 11, 2017. [Commit #bdad1fe](https://github.com/roots/sage/tree/bdad1fe3b19376919d80b8f001cf2f5c654fc19e)
- [Fewbricks](https://github.com/folbert/fewbricks) - A module system for Advanced Custom Fields PRO. Included using Composer. ACF PRO is not included in this repo (see "Plugins not included in Composer" later in this document) but required if you want to run Fewbricks (and recommended if you want to be able to build a user friendly and flexible admin area). If you aren't going ot use Fewbricks, make sure you delete the folder "fewbricks" in the theme folder. If you are going to use it, note that the project specific files are placed in the plugins/project-fewbricks.
- [Debug Bar](https://wordpress.org/plugins/debug-bar/) - Adds a debug menu to the admin bar that shows query, cache, and other helpful debugging information. Included using Composer.
- [Var Dumper](https://wordpress.org/plugins/var-dumper/) - A plugin to include var-dump package to use dump() function while developing or debugging. Included using Composer.

## Install

### 1. Get the server up and running
1. If you don't have [Vagrant](https://www.vagrantup.com/) installed, install it
2. If you need PHP7 and/or MySQL 5.6, check the [Vagrantfile](Vagrantfile) and uncomment lines as needed.
3. Set the domain in the Vagrantfile (`config.vm.hostname`).
4. Make sure that the IP-address in the Vagrantfile is not used by another Vagrant box. You can change this value later if needed so no big worries. 
5. Navigate to the directory that you cloned this repo to and run `vagrant up`.

### 2. Set up Bedrock
Bedrock comes with the repo, but you will need to set it up. These steps are replacing some of the steps in the standard WordPress install process. Below are the relevant steps from the [Bedrock install guide](https://roots.io/bedrock/docs/installing-bedrock/)

1. Copy `.env.example` to `.env` and update environment variables:
- `DB_NAME` - Database name ("scotchbox" when using Scoth Box)
- `DB_USER` - Database user ("root" when using Scotch Box)
- `DB_PASSWORD` - Database password ("root" when using Soctch Box)
- `DB_HOST` - Database host ("localhost" when using Soctch Box)
- `WP_ENV` - Set to environment (`development`, `staging`, `production`)
- `WP_HOME` - Full URL to WordPress home (http://example.com) (The same value as the one you set in the Vagrantfile but prepended with "http://")
- `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
- `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT` - Generate with wp-cli-dotenv-command or from the [Roots WordPress Salt Generator](https://roots.io/salts.html)

2. Run `composer update` in the root of the project (where this README is placed).

3. Access WP admin at http://[DOMAIN_IN_VAGRANTFILE]/wp/wp-admin

### Sage
The theme is placed in `web/app/themes/` and has been given the generic name `theme-2017-02`. You can rename it if you want to. Make sure that you also update the data in style.css. Be aware that renaming the theme, will make the data in the accompanied SQL-file invalid. The steps below are taken from the [README for Sage](web/app/themes/theme-2017-02/README.SAGE.md).
 
1. `cd web/app/themes/theme-2017-02/`
2. `npm install`
3. `bower install`
4. `gulp`
5. Done!

Activate the theme in the admin area and navigate to the front end.

### Plugins not included in Composer
Due to paid plugins and licenses, the following plugins must be installed manually. You will probably also want to keep them in your repo. Check "Plug ins to keep in the repo" in .gitignore and uncomment the lines for the plugins to keep in the repo. There are of course other ways to do this such as custom composer repos but let's keep it simple for now.

- [Advanced Custom Fields PRO](https://www.advancedcustomfields.com/). This is required by Fewbricks which is installed by composer. If you do not intend to use Fewbricks

### Yay!
All set up! Time to develop!

You may want to rename this file to README.BOILERPLATE.md or something ans create your own README for the project you are to embark on.