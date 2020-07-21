--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NumericValException;
use Respect\Validation\Validator as v;

try {
    v::numericVal()->check('a');
} catch (NumericValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::numericVal())->check('1');
} catch (NumericValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::numericVal()->assert('a');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::numericVal())->assert('1');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"a" must be numeric
"1" must not be numeric
- "a" must be numeric
- "1" must not be numeric
