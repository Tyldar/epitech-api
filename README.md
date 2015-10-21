# EpitechAPI
An easy and modular API to request information from the Epitech's intranet.

**I'm currently re-writting the project to make a v2. Don't use it for production projects but for testing.**

# Installation
The EpitechAPI library use PHP and its cURL extension
* [PHP >= 5.4](http://www.php.net/)
* [PHP cURL extension >= 7.0](http://php.net/manual/fr/book.curl.php/)

You can use [Composer](https://getcomposer.org/) on adding the dependency `raphy/epitech-api` with the command :
``` bash
$ php composer.phar require raphy/epitech-api "2.*@dev"
```

# Documentation
The documentation can be found at the `doc` directory in this repository.
You can read by starting at the [documentation main page](doc/index.md)

# Modularity
Since the components use the `EpitechAPI\Connector` class, the components can be diversified !
You can contribute and share your own components for a better EpitechAPI !

# Unit Tests
The repository is tested by Travis-CI. To test the authentication, it must be provided valid Epitech credentials.
So Travis-CI use encrypted variables for encrypt these information and it's impossible to make local test without using a script.

The following script allow you make local unit tests, replace the values by yours :

script : travis.sh
```bash
#!/bin/sh

export INTRANET_LOGIN=login_x # Your login
export INTRANET_PASSWORD=unix_password # Your password
export INTRANET_AUTOLOGIN_LINK=url # The autologin link provided by intranet at https://intra.epitech.eu/admin/autolog

composer update # Update or install the vendors

./vendor/bin/phpunit # Run the unit tests

```