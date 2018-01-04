--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::imei()->assert('490154203237518');
v::imei()->assertAll('356938035643809');
?>
--EXPECTF--
