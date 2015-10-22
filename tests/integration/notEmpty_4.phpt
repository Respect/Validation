--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Validator as v;

try {
    v::not(v::notEmpty())->check(1);
} catch (NotEmptyException $e) {
    echo $e->getMainMessage().PHP_EOL;
}

try {
    v::not(v::notEmpty())->assert([1]);
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
1 must be empty
- { 1 } must be empty
