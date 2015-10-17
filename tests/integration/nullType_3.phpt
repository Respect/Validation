--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::not(v::nullType())->assert('');
v::not(v::nullType())->assert(0);
v::not(v::nullType())->assert(false);
v::not(v::nullType())->check('');
v::not(v::nullType())->check(0);
v::not(v::nullType())->check(false);
?>
--EXPECTF--