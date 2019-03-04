--CREDITS--
Danilo Correa<danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\VowelException;
use Respect\Validation\Validator as v;

try {
    v::vowel()->check('D');
} catch (VowelException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::vowel('a')->check('Dan');
} catch (VowelException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::vowel())->check('aeiou');
} catch (VowelException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::vowel('Dn'))->check('Dan');
} catch (VowelException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::vowel()->assert('D');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::vowel('a')->assert('Dan');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::vowel())->assert('aeiou');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::vowel('Dn'))->assert('Dan');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

?>
--EXPECT--
"D" must contain only vowels
"Dan" must contain only vowels and "a"
"aeiou" must not contain vowels
"Dan" must not contain vowels or "Dn"
- "D" must contain only vowels
- "Dan" must contain only vowels and "a"
- "aeiou" must not contain vowels
- "Dan" must not contain vowels or "Dn"
