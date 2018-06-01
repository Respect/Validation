--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\AlwaysValidException;
use Respect\Validation\Validator as v;

try {
    v::not(v::alwaysValid())->check(true);
} catch (AlwaysValidException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::alwaysValid())->check(false);
} catch (AlwaysValidException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::alwaysValid())->assert('string');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::alwaysValid())->assert(new stdClass());
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`TRUE` is always invalid
`FALSE` is always invalid
- "string" is always invalid
- `[object] (stdClass: { })` is always invalid
