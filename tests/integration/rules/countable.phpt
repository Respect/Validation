--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\CountableException;
use Respect\Validation\Validator as v;

try {
    v::not(v::countable())->check([]);
} catch (CountableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::countable()->check(1.0);
} catch (CountableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::countable()->check(PHP_INT_MAX);
} catch (CountableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::countable()->check(true);
} catch (CountableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::countable()->check(new \stdClass());
} catch (CountableException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::countable()->assert('Not countable!');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::countable())->assert(new ArrayObject());
} catch (AllOfException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
`{ }` must not be countable
1.0 must be countable
9223372036854775807 must be countable
`TRUE` must be countable
`[object] (stdClass: { })` must be countable
- "Not countable!" must be countable
- `[traversable] (ArrayObject: { })` must not be countable
