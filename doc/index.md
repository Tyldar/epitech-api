# EpitechAPI Documentation

This is the main page of the documentation.

## A basic usage
Here a snippet of a basic usage.
This code will sign in you to the intranet, outputs your login and outputs the login of a random student.

```php
<?php
// ...

use EpitechAPI\Connector;
use EpitechAPI\Component\User

// Starting to initializing a new object of Connector.
$connector = new Connector();

// Now we choose to authenticate with credentials.
// See the « How to use EpitechAPI\Connector ? » documentation page to learn the different way of authentication.
$connector->authenticate(Connector::SIGN_IN_METHOD_CREDENTIALS, 'your login', 'your unix password'); // Don't forget to replace by your credentials !

// Checking if we are signed in
if ($connector->isSignedIn()) {

    // Outputs the signed in user login
    $signed_in_user = $connector->getUser();
    echo $signed_in_user->getLogin();

    // Getting a random student information
    $random_student = new User($connector, 'defrei_r');

    // Outputs his login
    echo $random_student->getLogin();

} else {
    echo 'You are not signed in, maybe bad credentials ?';
}

// ...
?>
```

## Connector
* [How to use EpitechAPI\Connector ?](connector.md)

## Components
* [How to make a component ?](make-component.md)
* [How to use EpitechAPI\Component\User ?](component-user.md)