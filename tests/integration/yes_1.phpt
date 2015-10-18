--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::yes()->check('Yes');
?>
--EXPECTF--
