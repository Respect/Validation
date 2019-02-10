--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PunctException;
use Respect\Validation\Validator as v;

try {
    v::punct()->check('16-50');
} catch (PunctException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::punct('16')->check('16-50');
} catch (PunctException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::punct())->check(',;:');
} catch (PunctException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::punct("abc123 \t\n"))->check("[]?+=/\\-_|\"',<>. \t \n abc 123");
} catch (PunctException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::punct()->assert('16-50');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::punct('16')->assert('16-50');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::punct())->assert(',;:');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::punct("abc123 \t\n"))->assert("[]?+=/\\-_|\"',<>. \t \n abc 123");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"16-50" must contain only punctuation characters
"16-50" must contain only punctuation characters and "16"
",;:" must not contain punctuation characters
"[]?+=/\\-_|\"',<>. \t \n abc 123" must not contain punctuation characters or "abc123 \t\n"
- "16-50" must contain only punctuation characters
- "16-50" must contain only punctuation characters and "16"
- ",;:" must not contain punctuation characters
- "[]?+=/\\-_|\"',<>. \t \n abc 123" must not contain punctuation characters or "abc123 \t\n"
