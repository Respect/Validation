--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::nullType()->assert(null);
v::nullType()->check(null);

?>
--EXPECTF--