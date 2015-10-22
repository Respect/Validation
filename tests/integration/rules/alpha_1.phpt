--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::alpha()->assert('abc');
v::alpha()->check('abc');

?>
--EXPECTF--