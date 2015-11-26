# EpitechAPI

**This repository is abandoned and the project is rewritten at [raphy/epitech-intranet](https://github.com/Raphy/epitech-intranet)**

![](https://travis-ci.org/Raphy/epitech-api.svg?branch=master)

An easy to use and modular API to request information from Epitech's intranet.

## Requirements
The EpitechAPI library has the following requirements:
* [PHP](http://www.php.net/): >= 5.4
* [PHP cURL extension](http://php.net/manual/fr/book.curl.php/): *

## Installation
The library is available on [Packagist](https://packagist.org/) [here](https://packagist.org/packages/raphy/epitech-api). Install it via [Composer](https://getcomposer.org/):
``` sh
composer require raphy/epitech-api
```

## Documentation
The main documentation can be found at the `doc` directory in this repository.
You can read by starting at the [documentation main page](doc/index.md)

The API documentation is built with [Sami](https://github.com/FriendsOfPHP/Sami) and hosted on [GitHub Pages](https://pages.github.com/). It is available [here](http://raphy.github.io/epitech-api/master/).

Generate the API documentation by running the command:
``` sh
composer sami
```

## Modularity
Since the components use the `EpitechAPI\Connector` class, the components can be diversified!
You can contribute and share your own components for a better EpitechAPI!

## Unit Tests
The repository is tested by [Travis-CI](https://travis-ci.org/). See the build status [here](https://travis-ci.org/Raphy/epitech-api).

The unit tests are made with [PHPUnit](https://phpunit.de/). To launch the unit tests, run:
``` sh
composer phpunit
```
