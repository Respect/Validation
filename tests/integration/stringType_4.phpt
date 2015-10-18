--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\StringTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::stringType())->check('hello world');
} catch (StringTypeException $e) {
    echo $e->getMainMessage();
}
?>
--EXPECTF--
"hello world" must not be string
