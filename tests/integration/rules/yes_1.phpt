--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::yes()->assert('Yes');
?>
--EXPECTF--
