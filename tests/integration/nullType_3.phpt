--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NullTypeException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::nullType()->setName('Field')->check('');
} catch (NullTypeException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::nullType()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must be null
\-Field must be null
