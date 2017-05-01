--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

date_default_timezone_set('UTC');

v::allOf(v::intVal(), v::positive())->assert(42);
v::allOf(v::intVal(), v::negative())->check(-42);
v::not(v::allOf(v::dateTime(), v::between('2014-12-01', '2014-12-12')))->assert('2012-01-01');
v::not(v::allOf(v::stringType(), v::consonant()))->check('I am Jack\'s smirking revenge');
?>
--EXPECTF--
