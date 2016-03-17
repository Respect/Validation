--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::equals('test 123')->assert('test 123');
v::equals('test 123')->check('test 123');
?>
--EXPECTF--
