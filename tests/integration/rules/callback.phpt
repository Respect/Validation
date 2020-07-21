--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::callback('is_string')->check([]);
} catch (CallbackException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::callback('is_string'))->check('foo');
} catch (CallbackException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::callback('is_string')->assert(true);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::callback('is_string'))->assert('foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
`{ }` must be valid
"foo" must not be valid
- `TRUE` must be valid
- "foo" must not be valid
