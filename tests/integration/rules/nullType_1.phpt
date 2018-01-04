--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::nullType()->assertAll(null);
v::nullType()->assert(null);

?>
--EXPECTF--