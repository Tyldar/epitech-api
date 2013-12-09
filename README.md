# EpitechAPI
An easy and modular API to request information from the Epitech's intranet

# Installation
The EpitechAPI library use cURL extension and PHP.
* [PHP](http://www.php.net/)
* [cURL extension](http://php.net/manual/fr/book.curl.php/)

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

# Modularity
Since the components use the `EpitechAPI\Connector` class, the components can be diversified !
You can contribuate and share your own components for a better EpitechAPI !




