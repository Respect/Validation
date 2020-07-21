--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ReadableException;
use Respect\Validation\Validator as v;

try {
    v::readable()->check('tests/fixtures/invalid-image.jpg');
} catch (ReadableException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::readable())->check('tests/fixtures/valid-image.png');
} catch (ReadableException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::readable()->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::readable())->assert('tests/fixtures/valid-image.png');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"tests/fixtures/invalid-image.jpg" must be readable
"tests/fixtures/valid-image.png" must not be readable
- `[object] (stdClass: { })` must be readable
- "tests/fixtures/valid-image.png" must not be readable
