--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::unique()->assert([]);
v::unique()->check([1, 2, 3]);
?>
--EXPECTF--
