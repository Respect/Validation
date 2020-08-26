--CREDITS--
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\ConsonantException;
use Respect\Validation\Exceptions\IntTypeException;
use Respect\Validation\Validator as v;

try {
    v::not(v::allOf(v::intType(), v::positive()))->check(42);
} catch (IntTypeException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::allOf(v::stringType(), v::consonant())->check('Luke i\'m your father');
} catch (ConsonantException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::allOf(v::stringType(), v::consonant())->assert(42);
} catch (AllOfException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::allOf(v::stringType(), v::length(10)))->assert('Frank Zappa is fantastic');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
42 must not be of type integer
"Luke i'm your father" must contain only consonants
- All of the required rules must pass for 42
  - 42 must be of type string
  - 42 must contain only consonants
- "Frank Zappa is fantastic" must not be of type string
