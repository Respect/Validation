--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::callableType()->isValid(function (): void {
});
v::callableType()->isValid('trim');
v::callableType()->isValid(v::callableType(), 'validate');
?>
--EXPECTF--
