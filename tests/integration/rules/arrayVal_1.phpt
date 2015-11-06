--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::arrayVal()->assert(['asdf', 'lkjh']);
v::arrayVal()->check(new ArrayObject([2, 3]));
?>
--EXPECTF--
