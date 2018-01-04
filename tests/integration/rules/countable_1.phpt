--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::countable()->assertAll([]);
v::countable()->assert(new ArrayIterator());
?>
--EXPECTF--
