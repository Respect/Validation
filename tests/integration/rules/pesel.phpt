--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\PeselException;
use Respect\Validation\Validator as v;

try {
    v::pesel()->check('21120209251');
} catch (PeselException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::pesel())->check('21120209256');
} catch (PeselException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::pesel()->assert('21120209251');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::pesel())->assert('21120209256');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--;
"21120209251" must be a valid PESEL
"21120209256" must not be a valid PESEL
- "21120209251" must be a valid PESEL
- "21120209256" must not be a valid PESEL
