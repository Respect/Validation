--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::callableType()->validate(function (): void {
});
v::callableType()->validate('trim');
v::callableType()->validate(v::callableType(), 'validate');
?>
--EXPECTF--
