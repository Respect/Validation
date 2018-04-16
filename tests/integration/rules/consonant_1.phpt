--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::consonant()->check('bcd');
v::consonant()->assert('ddd');
v::not(v::consonant())->check('uou');
v::not(v::consonant())->assert('aaaaa');
?>
--EXPECTF--
