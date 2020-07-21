--CREDITS--
Bram Van der Sype <bram.vandersype@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Validator as v;

try {
    v::notEmpty()->check(null);
} catch (NotEmptyException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    v::notEmpty()->setName('Field')->check(null);
} catch (NotEmptyException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    v::not(v::notEmpty())->check(1);
} catch (NotEmptyException $e) {
    echo $e->getMessage() . PHP_EOL;
}

try {
    v::notEmpty()->assert('');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage() . PHP_EOL;
}

try {
    v::notEmpty()->setName('Field')->assert('');
} catch (NestedValidationException $e) {
    echo $e->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::notEmpty())->assert([1]);
} catch (NestedValidationException $e) {
    echo $e->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
The value must not be empty
Field must not be empty
1 must be empty
- The value must not be empty
- Field must not be empty
- `{ 1 }` must be empty
