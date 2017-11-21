--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::arrayVal()->assertAll(['asdf', 'lkjh']);
v::arrayVal()->assert(new ArrayObject([2, 3]));
?>
--EXPECTF--
