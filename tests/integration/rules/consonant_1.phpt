--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::consonant()->assert('bcd');
v::consonant()->assertAll('ddd');
v::not(v::consonant())->assert('uou');
v::not(v::consonant())->assertAll('aaaaa');
?>
--EXPECTF--
