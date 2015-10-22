--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::email()->assert('batman@gothancity.com');
v::email()->check('jocker@gothancity.com');
?>
--EXPECTF--
