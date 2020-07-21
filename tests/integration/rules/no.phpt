--CREDITS--
Henrique Moody <henriquemoody@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NoException;
use Respect\Validation\Validator as v;

try {
    v::not(v::no())->check('No');
} catch (NoException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::no()->check('Yes');
} catch (NoException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::no())->assert('No');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::no()->assert('Yes');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"No" is considered as "No"
"Yes" is not considered as "No"
- "No" is considered as "No"
- "Yes" is not considered as "No"
