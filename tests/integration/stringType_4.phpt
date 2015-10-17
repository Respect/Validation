--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\StringTypeException;

try {
    v::not(v::stringType())->check('hello world');
} catch (StringTypeException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"hello world" must not be string
