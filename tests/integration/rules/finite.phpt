--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FiniteException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::finite()->check(' ');
} catch (FiniteException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::finite())->check(10);
} catch (FiniteException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::finite()->assert([]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::finite())->assert('123456');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
" " must be a finite number
10 must not be a finite number
- `{ }` must be a finite number
- "123456" must not be a finite number