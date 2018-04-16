--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::nif()->check('43333207B');
?>
--EXPECTF--
