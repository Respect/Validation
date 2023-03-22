--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\FalseValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::falseVal()->check(true);
} catch (FalseValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::falseVal())->check('false');
} catch (FalseValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::falseVal()->assert(1);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::falseVal())->assert(0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
`TRUE` must evaluate to `false`
"false" must not evaluate to `false`
- 1 must evaluate to `false`
- 0 must not evaluate to `false`
