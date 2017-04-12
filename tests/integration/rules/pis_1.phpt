--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::pis()->check('12017723640');
v::pis()->assert('120.6671.406-4');
?>
--EXPECTF--
