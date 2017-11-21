--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::email()->assertAll('batman@gothancity.com');
v::email()->assert('jocker@gothancity.com');
?>
--EXPECTF--
