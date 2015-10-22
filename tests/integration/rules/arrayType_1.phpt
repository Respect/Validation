--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::arrayType()->assert([]);
v::arrayType()->check([1, 2, 3]);
?>
--EXPECTF--
