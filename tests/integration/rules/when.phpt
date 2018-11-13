--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\BetweenException;
use Respect\Validation\Exceptions\IntValException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\WhenException;
use Respect\Validation\Rules\Between;
use Respect\Validation\Rules\IntVal;
use Respect\Validation\Rules\NotEmpty;
use Respect\Validation\Validator as v;

try {
    v::when(new Between(1, 5), new NotEmpty(), new IntVal())->check('abc');
} catch (IntValException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::when(new NotEmpty(), new Between(1, 5), new IntVal())->check('abc');
} catch (BetweenException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::when(new IntVal(), new Between(1, 5), new NotEmpty()))->check('abc');
} catch (WhenException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::when(new IntVal(), new Between(1, 5), new NotEmpty()))->check('2');
} catch (WhenException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::when(new IntVal(), new Between(1, 5), new NotEmpty())->assert(null);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::when(new IntVal(), new Between(1, 5), new NotEmpty())->assert(20);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::when(new IntVal(), new Between(1, 5), new NotEmpty()))->assert(4);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::when(new Between(1, 5), new NotEmpty(), new IntVal()))->assert(10);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"abc" must be an integer number
"abc" must be between 1 and 5
Data validation failed for "abc"
Data validation failed for "2"
- The value must not be empty
- 20 must be between 1 and 5
- Data validation failed for 4
- Data validation failed for 10
