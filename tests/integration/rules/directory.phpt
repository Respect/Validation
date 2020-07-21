--CREDITS--
William Espindola <oi@williamespindola.com.br>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\DirectoryException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::directory()->check('batman');
} catch (DirectoryException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::directory())->check(dirname('/etc/'));
} catch (DirectoryException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::directory()->assert('ppz');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::directory())->assert(dirname('/etc/'));
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"batman" must be a directory
"/" must not be a directory
- "ppz" must be a directory
- "/" must not be a directory
