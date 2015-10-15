--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NotOptionalException;
use Respect\Validation\Exceptions\AllOfException;

try {
    v::notOptional()->check(null);
} catch (NotOptionalException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notOptional()->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
null must not be optional
\-"" must not be optional
