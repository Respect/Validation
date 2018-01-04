--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::boolVal()->assertAll(1);
v::boolVal()->assertAll('on');
v::boolVal()->assertAll('off');
v::boolVal()->assertAll('yes');
v::boolVal()->assertAll('no');
v::boolVal()->assertAll(true);
v::boolVal()->assertAll(false);

v::boolVal()->assert(1);
v::boolVal()->assert('on');
v::boolVal()->assert('off');
v::boolVal()->assert('yes');
v::boolVal()->assert('no');
v::boolVal()->assert(true);
v::boolVal()->assert(false);
?>
--EXPECTF--
