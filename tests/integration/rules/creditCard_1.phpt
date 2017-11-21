--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::creditCard()->assertAll('5555 4444 3333 1111');
v::creditCard()->assert('4111 1111 1111 1111');

?>
--EXPECTF--
