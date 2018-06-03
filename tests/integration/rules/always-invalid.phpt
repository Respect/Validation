--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\AlwaysInvalidException;
use Respect\Validation\Validator as v;

try {
    v::alwaysInvalid()->check('whatever');
} catch (AlwaysInvalidException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::alwaysInvalid()->assert('');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"whatever" is always invalid
- "" is always invalid
