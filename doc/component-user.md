# How to use EpiteachAPI\Component\User ?
This component provides information about an Epitech user.

The constructor takes the signed in [EpitechAPI\Connector](connector.md).
You can add an optional argument : the login of the user you want to get information.

```php
// ...

use EpitechAPI\Component\User;

// Here you have a signed in connector

$signed_in_user = new User($connector);

$defrei_r_user = new User($connector, 'defrei_r');

// ...
```

Now browse the class to find the getters which provides user information.

___
[Back to index](index.md)