--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::callableType()->validate(function () {
});
v::callableType()->validate('trim');
v::callableType()->validate(v::callableType(), 'validate');
?>
--EXPECTF--
