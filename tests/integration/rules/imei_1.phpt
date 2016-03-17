--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::imei()->check('490154203237518');
v::imei()->assert('356938035643809');
?>
--EXPECTF--
