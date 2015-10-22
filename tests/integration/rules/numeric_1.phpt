--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::numeric()->assert(123);
v::numeric()->check(123);

?>
--EXPECTF--