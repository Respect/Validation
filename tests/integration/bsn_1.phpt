--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::bsn()->assert('612890053');
?>
--EXPECTF--
