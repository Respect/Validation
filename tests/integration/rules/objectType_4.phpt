--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::not(v::objectType())->check('');
v::not(v::objectType())->check(true);
v::not(v::objectType())->check(0);
?>
--EXPECTF--