--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
Edson Lima <dddwebdeveloper@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ConsonantException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::consonant()->check('aeiou');
} catch (ConsonantException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::consonant('d')->check('daeiou');
} catch (ConsonantException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::consonant())->check('bcd');
} catch (ConsonantException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::consonant('a'))->check('abcd');
} catch (ConsonantException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::consonant()->assert('aeiou');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::consonant('d')->assert('daeiou');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::consonant())->assert('bcd');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::consonant('a'))->assert('abcd');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"aeiou" must contain only consonants
"daeiou" must contain only consonants and "d"
"bcd" must not contain consonants
"abcd" must not contain consonants or "a"
- "aeiou" must contain only consonants
- "daeiou" must contain only consonants and "d"
- "bcd" must not contain consonants
- "abcd" must not contain consonants or "a"
