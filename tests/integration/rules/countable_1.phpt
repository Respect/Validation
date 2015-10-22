--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::countable()->assert([]);
v::countable()->check(new ArrayIterator());
?>
--EXPECTF--
