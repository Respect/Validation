--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Validator as v;

v::intType()->between(1, 42)->check(2);
v::intType()->between(1, 2)->assert(2);
v::dateTime()->between('1989-12-20', 'tomorrow', false)->assert(new DateTime());
v::stringType()->between('a', 'e', false)->assert('d');

?>
--EXPECTF--
