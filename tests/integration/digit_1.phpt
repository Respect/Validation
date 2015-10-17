--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::digit()->assert(1);
v::digit()->check(1);

--EXPECTF--
