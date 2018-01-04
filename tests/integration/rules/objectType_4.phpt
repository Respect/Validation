--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::not(v::objectType())->assert('');
v::not(v::objectType())->assert(true);
v::not(v::objectType())->assert(0);
?>
--EXPECTF--