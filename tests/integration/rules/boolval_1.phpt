--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::boolVal()->assert(1);
v::boolVal()->assert('on');
v::boolVal()->assert('off');
v::boolVal()->assert('yes');
v::boolVal()->assert('no');
v::boolVal()->assert(true);
v::boolVal()->assert(false);

v::boolVal()->check(1);
v::boolVal()->check('on');
v::boolVal()->check('off');
v::boolVal()->check('yes');
v::boolVal()->check('no');
v::boolVal()->check(true);
v::boolVal()->check(false);
?>
--EXPECTF--
