--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::bsn()->check('612890053');
?>
--EXPECTF--
