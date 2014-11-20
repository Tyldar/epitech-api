# How to use EpitechAPI\Connector ?
The class EpitechAPI\Connector is the main class of the API.
You have to sign in before using the components.

```php
<?php
// ...

// Initializing a new instance of the class Connector
$connector = new Epitech\Connector();

// ...
?>
```

## The authentication methods
The Connector allows 3 different way of authentication.
Once you are sign in, you can't sign in anymore with the same object.

### Using credentials
Use a login and an unix password.

```php
<?php
// ...

$connector->authenticate(EpitechAPI\Connector::SIGN_IN_METHOD_CREDENTIALS, 'login_x', 'unix_password');
if ($connector->isSignedIn())
    echo 'You are signed in';
else
    echo 'You are not signed in';

// ...
?>
```

### Using autologin link
Use the autologin link provided by the intranet at https://intra.epitech.eu/admin/autolog

```php
<?php
// ...

$connector->authenticate(EpitechAPI\Connector::SIGN_IN_METHOD_AUTOLOGIN_LINK, 'full link provided by the intranet');
if ($connector->isSignedIn())
    echo 'You are signed in';
else
    echo 'You are not signed in';

// ...
?>
```

### Using a PHPSESSID
Use the session cookie of the intranet

```php
<?php
// ...

$connector->authenticate(EpitechAPI\Connector::SIGN_IN_METHOD_PHPSESSID, 'value of the cookie PHPSESSID');
if ($connector->isSignedIn())
    echo 'You are signed in';
else
    echo 'You are not signed in';

// ...
?>
```

## Getting the PHPSESSID
Once you are signed in, you can obtain the value of the cookie PHPSESSID provided by the intranet.

```php
<?php
// ...

echo 'Your PHPSESSID cookie is : ';
echo $connector->getPHPSESSID();

// ...
?>
```

___
[Back to index](index.md)