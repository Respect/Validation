--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NotOptionalException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::notOptional()->setName('Field')->check(null);
} catch (NotOptionalException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notOptional()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must not be optional
\-Field must not be optional
