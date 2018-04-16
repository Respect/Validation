--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::numericVal()->assert(123);
v::numericVal()->check(123);

?>
--EXPECTF--