--FILE--
<?php

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\LengthException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::length(0, 5)->check('phpsp.org.br');
} catch (LengthException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::length(20)->check('phpsp.org.br');
} catch (LengthException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::length(5, 10)->check('phpsp.org.br');
} catch (LengthException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::length(0, 20))->check('phpsp.org.br');
} catch (LengthException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::length(10))->check('phpsp.org.br');
} catch (LengthException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::length(5, 20))->check('phpsp.org.br');
} catch (LengthException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::length(0, 5)->assert('phpsp.org.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::length(20)->assert('phpsp.org.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::length(5, 10)->assert('phpsp.org.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::length(0, 20))->assert('phpsp.org.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::length(10))->assert('phpsp.org.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::length(5, 20))->assert('phpsp.org.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"phpsp.org.br" must have a length lower than 5
"phpsp.org.br" must have a length greater than 20
"phpsp.org.br" must have a length between 5 and 10
"phpsp.org.br" must not have a length lower than 20
"phpsp.org.br" must not have a length greater than 10
"phpsp.org.br" must not have a length between 5 and 20
- "phpsp.org.br" must have a length lower than 5
- "phpsp.org.br" must have a length greater than 20
- "phpsp.org.br" must have a length between 5 and 10
- "phpsp.org.br" must not have a length lower than 20
- "phpsp.org.br" must not have a length greater than 10
- "phpsp.org.br" must not have a length between 5 and 20
