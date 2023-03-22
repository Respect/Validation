--CREDITS--
Paul Karikari <paulkarikari1@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\TrueValException;
use Respect\Validation\Validator as v;

try {
    v::trueVal()->check(false);
} catch (TrueValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::trueVal())->check(1);
} catch (TrueValException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::trueVal()->assert(0);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::trueVal())->assert('true');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
`FALSE` must evaluate to `true`
1 must not evaluate to `true`
- 0 must evaluate to `true`
- "true" must not evaluate to `true`
