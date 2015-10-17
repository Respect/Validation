--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

var_dump(v::yes()->validate(null));
?>
--EXPECTF--
bool(false)
