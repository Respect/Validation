--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NullTypeException;

try {
  v::not(v::nullType())->check(null);
} catch (NullTypeException $exception) {
  echo $exception->getMainMessage().PHP_EOL;
}

?>
--EXPECTF--
null must not be null