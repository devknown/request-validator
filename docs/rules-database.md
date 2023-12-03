# Rules Database

Some of the existing rules requires to connect via database to check some table's column or the value, etc.

Rules who uses this:
- Unique
- Exists

```php
<?php

use Devknown\Validator\Validator as v;
use Devknown\Validator\DbProviders\PdoAdapter;        // PDO
use Devknown\Validator\DbProviders\MysqliAdapter;        // Mysqli
use Devknown\Validator\DbProviders\PhalconAdapter;    // Phalcon
use Devknown\Validator\DbProviders\WordpressAdapter;  // Wordpress

# to set the data adapter
v::setDataProvider(PhalconAdapter::class);
v::setDataProvider(WordpressAdapter::class);

# for PDO
v::setDataProvider(PdoAdapter::class);
$pdoInstance = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
v::setupPDO($pdoInstance);

# for Mysqli
v::setDataProvider(MysqliAdapter::class);
$mysqliInstance = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
v::setupMysqli($mysqliInstance);


$validation = v::make($_POST, [
    'email'           => 'required|email|unique:users'
    'password'        => 'min:6',
    'password_repeat' => 'same:password',
    'json'            => 'json',
]);

```
