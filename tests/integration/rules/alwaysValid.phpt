--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AlwaysValidException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::not(v::alwaysValid())->check(true);
} catch (AlwaysValidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::alwaysValid())->assert(true);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
`TRUE` is always invalid
- `TRUE` is always invalid
