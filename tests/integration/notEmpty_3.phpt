--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Validator as v;

try {
    v::notEmpty()->setName('Field')->check(null);
} catch (NotEmptyException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::notEmpty()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
Field must not be empty
- Field must not be empty
