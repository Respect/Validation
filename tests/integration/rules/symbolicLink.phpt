--CREDITS--
Gus Antoniassi <gus.antoniassi@gmail.com>
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SymbolicLinkException;
use Respect\Validation\Validator as v;

try {
    v::symbolicLink()->check('tests/fixtures/fake-filename');
} catch (SymbolicLinkException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::symbolicLink())->check('tests/fixtures/symbolic-link');
} catch (SymbolicLinkException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::symbolicLink()->assert('tests/fixtures/fake-filename');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::symbolicLink())->assert('tests/fixtures/symbolic-link');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"tests/fixtures/fake-filename" must be a symbolic link
"tests/fixtures/symbolic-link" must not be a symbolic link
- "tests/fixtures/fake-filename" must be a symbolic link
- "tests/fixtures/symbolic-link" must not be a symbolic link
