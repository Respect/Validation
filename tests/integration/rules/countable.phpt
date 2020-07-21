--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CountableException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::countable()->check(1.0);
} catch (CountableException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::countable())->check([]);
} catch (CountableException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::countable()->assert('Not countable!');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::countable())->assert(new ArrayObject());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
1.0 must be countable
`{ }` must not be countable
- "Not countable!" must be countable
- `[traversable] (ArrayObject: { })` must not be countable
