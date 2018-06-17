--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ExecutableException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::executable()->check('bar');
} catch (ExecutableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::executable())->check('tests/fixtures/executable');
} catch (ExecutableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::executable()->assert('bar');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::executable())->assert('tests/fixtures/executable');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
"bar" must be an executable file
"tests/fixtures/executable" must not be an executable file
- "bar" must be an executable file
- "tests/fixtures/executable" must not be an executable file
