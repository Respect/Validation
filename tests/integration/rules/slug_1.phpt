--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::slug()->assert('getting-started-to-respect-validation');
v::slug()->assertAll('welcome-to-php-7');
?>
--EXPECTF--
