--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::pis()->assert('12017723640');
v::pis()->assertAll('120.6671.406-4');
?>
--EXPECTF--
