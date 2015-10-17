--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\CallableTypeException;

try {
  v::not(v::callableType())->check(function () {});
} catch (CallableTypeException $e) {
  echo $e->getMainMessage().PHP_EOL;
}

try {
  v::not(v::callableType())->check('trim');
} catch (CallableTypeException $e) {
  echo $e->getMainMessage().PHP_EOL;
}

try {
  v::not(v::callableType())->check(v::callableType(), 'validate');
} catch (CallableTypeException $e) {
  echo $e->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
`[object] (Closure: { })` must not be a callable
"trim" must not be a callable
`[object] (Respect\Validation\Validator: { })` must not be a callable