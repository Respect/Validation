--CREDITS--
Danilo Benevides <danilobenevides01@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\IntValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::intVal()->check('42.33');
} catch (IntValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::intVal())->check(2);
} catch (IntValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::intVal()->assert('Foo');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::intVal())->assert(3);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"42.33" must be an integer number
2 must not be an integer number
- "Foo" must be an integer number
- 3 must not be an integer number
