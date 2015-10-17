--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::bsn()->validate('abc'));
?>
--EXPECTF--
bool(false)
