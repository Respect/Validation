--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NullTypeException;

try {
  v::nullType()->check('');
} catch (NullTypeException $exception) {
  echo $exception->getMainMessage().PHP_EOL;
}

try {
  v::nullType()->check(0);
} catch (NullTypeException $exception) {
  echo $exception->getMainMessage().PHP_EOL;
}

try {
  v::nullType()->check(false);
} catch (NullTypeException $exception) {
  echo $exception->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
"" must be null
0 must be null
false must be null