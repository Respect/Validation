--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
Julián Gutiérrez <juliangut@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NifException;
use Respect\Validation\Validator as v;

try {
    v::nif()->check('06357771Q');
} catch (NifException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::nif())->check('71110316C');
} catch (NifException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::nif()->assert('06357771Q');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::nif())->assert('R1332622H');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"06357771Q" must be a NIF
"71110316C" must not be a NIF
- "06357771Q" must be a NIF
- "R1332622H" must not be a NIF
