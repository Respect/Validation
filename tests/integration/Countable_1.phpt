--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::Countable()->assert(array());
v::Countable()->check(new \ArrayIterator());

?>
--EXPECTF--
