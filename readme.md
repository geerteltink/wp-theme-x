# WordPress Theme-X Framework

This WordPress theme can be used stand-alone, but it's best extended by a child theme.

## Building assets

Assets are already pre-compiled, but if you like you can change files and compile the assets again. For this NodeJS and npm are required. Instead of using Grunt, npm scripts are used for building assets. A Grunt configuration file can become very complicated and causes a lot of overhead.

The npm scripts can be run on windows and unix (or within your Vagrant box). This might change in the future to unix only if required, but so far they are compatible.

## Watching assets for changes

If any assets changed in the ``src/`` while big brother is watching, assets are compiled and reloaded as long as 'WP_DEBUG = true'. This is done with LiveReload and a JavaScript being injected that takes care of this. No need for any browser plugins. This is done for you.

## Using npm run commands

Packages are installed globally... I know this is bad practice, but the few that are needed are required for other (child) themes as well. During setup ``sudo`` is needed. Besides that windows is choking in paths that are too long and the wordpress theme check plugin as well.

    // Install packages globally. Run as root on unix systems.
    sudo npm run setup

    // Update assets dependencies like jQuery and bootstrap. Managed by bower.
    npm run update

    // In case the assets path need to be reset.
    npm run clean

    // Build assets.
    npm run build

    // Watch assets for changes.  
    npm run watch
