--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::unique()->assertAll([]);
v::unique()->assert([1, 2, 3]);
?>
--EXPECTF--
