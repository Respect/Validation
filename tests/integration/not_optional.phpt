--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::int()->validate(''));
var_dump(v::notOptional()->int()->validate(''));
?>
--EXPECTF--
bool(true)
bool(false)
