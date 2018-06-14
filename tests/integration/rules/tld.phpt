--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\TldException;
use Respect\Validation\Validator as v;

try {
    v::tld()->check('42');
} catch (TldException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::tld())->check('com');
} catch (TldException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::tld()->assert('1984');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::tld())->assert('com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"42" must be a valid top-level domain name
"com" must not be a valid top-level domain name
- "1984" must be a valid top-level domain name
- "com" must not be a valid top-level domain name
