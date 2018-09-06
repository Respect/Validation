--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AlphaException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::alpha()->check('aaa%a');
} catch (AlphaException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::alpha(' ')->check('bbb%b');
} catch (AlphaException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::alpha())->check('ccccc');
} catch (AlphaException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::alpha('% '))->check('ddd%d');
} catch (AlphaException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::alpha()->assert('eee^e');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::alpha())->assert('fffff');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::alpha('* &%')->assert('ggg^g');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::alpha('^'))->assert('hhh^h');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"aaa%a" must contain only letters (a-z)
"bbb%b" must contain only letters (a-z) and " "
"ccccc" must not contain letters (a-z)
"ddd%d" must not contain letters (a-z) or "% "
- "eee^e" must contain only letters (a-z)
- "fffff" must not contain letters (a-z)
- "ggg^g" must contain only letters (a-z) and "* &%"
- "hhh^h" must not contain letters (a-z) or "^"
