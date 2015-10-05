--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::int()->validate(''));
var_dump(v::int()->validate(null));

v::setOptionalValues(array('', null));

var_dump(v::int()->validate(''));
var_dump(v::int()->validate(null));
?>
--EXPECTF--
bool(true)
bool(false)
bool(true)
bool(true)
