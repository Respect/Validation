--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Validator as v;

v::intType()->between(1, 42)->assert(2);
v::intType()->between(1, 2)->assertAll(2);
v::dateTime()->between('1989-12-20', 'tomorrow', false)->assertAll(new DateTime());
v::stringType()->between('a', 'e', false)->assertAll('d');

?>
--EXPECTF--
