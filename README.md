# EpitechAPI
An easy and modular API to request information from the Epitech's intranet

[![Build Status](https://travis-ci.org/Raphy/epitech-api.png?branch=master)](https://travis-ci.org/Raphy/epitech-api)

# Installation
The EpitechAPI library use cURL extension and PHP.
* [PHP](http://www.php.net/)
* [cURL extension](http://php.net/manual/fr/book.curl.php/)

You can use [Composer](https://getcomposer.org/) on adding the dependency `raphy/epitech-api`

# Getting started
The EpitechAPI must be easy to use

## `EpitechAPI\Settings`
The only use of this class is to provides the settings to the components and the global process.

## `EpitechAPI\Connector`
This class is the main class of the API.
It authenticates a specified user to have the access to the intranet.
It allows to make requests from the intranet and retrieve data.

A basic usage is
```
$connector = new EpitechAPI\Connector('login_x', 'unix_password'); // Make sure to provide valid identifiers ;)
if ($connector->isSignedIn())
  echo 'You are signed in !';
else
  echo 'Ohh you are not signed in :(';
  
// You can make a request using the request() method
$res = $connector->request('an url from the intranet');
print_r($res); // A string of the response content
```

# Components
The components use the `EpitechAPI\Connector` class to make the requests

## `EpitechAPI\Components\Student`
This class provides information about a specified student.

```
$student = new EpitechAPI\Components\Student($connector, 'defrei_r');

print_r($student->getData()); // Displays the information about 'defrei_r'
```

## `EpitechAPI\Components\StudentNetsoulStats`
This class provides netsoul stats about a specified student.

```
$netsoul = new EpitechAPI\Components\StudentNetsoulStats($connector, 'defrei_r');

print_r($netsoul->getData()); // Displays the information about 'defrei_r'
print_r($netsoul->getStats());
print_r($netsoul->getStatsFromDateTime(new DateTime()));
```

# Modularity
Since the components use the `EpitechAPI\Connector` class, the components can be diversified !
You can contribuate and share your own components for a better EpitechAPI !

# The components to develop
* Signed in schedule: https://intra.epitech.eu/planning/load?format=json  [&start=<DATE START>&end=<DATE END>]
* Signed in personal-schedules: https://intra.epitech.eu/planning/my-schedules?format=json
* Signed in modules: https://intra.epitech.eu/module/board/?format=json   [&start=<DATE START>&end=<DATE END>]
* Signed in notification missed: https://intra.epitech.eu/user/{LOGIN}/notification/missed/?format=json

And much more when you sniff the HTTP packets from the intranet ;)