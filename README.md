# EpitechAPI
An easy and modular API to request information from the Epitech's intranet.

# Installation
The EpitechAPI library use PHP and its cURL extension
* [PHP >= 5.4](http://www.php.net/)
* [PHP cURL extension >= 7.0](http://php.net/manual/fr/book.curl.php/)

You can use [Composer](https://getcomposer.org/) on adding the dependency `raphy/epitech-api` with the command :
``` bash
$ php composer.phar require raphy/epitech-api "~2.0"
```

# Documentation
The documentation can be found at the `doc` directory in this repository.
You can read by starting at the [documentation main page](doc/index.md)

# Modularity
Since the components use the `EpitechAPI\Connector` class, the components can be diversified !
You can contribute and share your own components for a better EpitechAPI !