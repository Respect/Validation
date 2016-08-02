--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::iterableType()->assert('String');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}

?>
--EXPECTF--
- "String" must be iterable
