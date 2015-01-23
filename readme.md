# WordPress Theme-X Framework

This WordPress theme can be used stand-alone, but it's best extended by a child theme.

## Building assets

Assets are already pre-compiled, but if you like you can change files and compile the assets again. For this NodeJS and npm are required. Instead of using Grunt, npm scripts are used for building assets. A Grunt configuration file can become very complicated and causes a lot of overhead.

### Install / update npm packages

Packages are installed globally... !!! I know this is bad practice, but the few that are needed are required for other (child) themes as well. During setup ``sudo`` is needed.

    sudo npm run setup

### Update dependencies

Dependencies like jQuery and bootstrap are managed under the hood by bower. all you need to know is this command:

    npm run update

### Build assets

Assets can be build with:

    npm run build
