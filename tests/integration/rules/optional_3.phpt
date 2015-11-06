--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\OptionalException;
use Respect\Validation\Validator as v;

try {
    v::not(v::optional(v::equals('foo'))->setName('My field'))->check(null);
} catch (OptionalException $e) {
    echo $e->getMainMessage().PHP_EOL;
}
?>
--EXPECTF--
My field must not be optional
