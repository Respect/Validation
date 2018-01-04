--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::alpha()->assertAll('abc');
v::alpha()->assert('abc');

?>
--EXPECTF--