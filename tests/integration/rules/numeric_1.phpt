--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::numericVal()->assertAll(123);
v::numericVal()->assert(123);

?>
--EXPECTF--