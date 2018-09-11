--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\NotBlankException;
use Respect\Validation\Validator as v;

try {
    v::notBlank()->check(null);
} catch (NotBlankException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::notBlank()->setName('Field')->check(null);
} catch (NotBlankException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::notBlank())->check(1);
} catch (NotBlankException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::notBlank()->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::notBlank()->setName('Field')->assert('');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::notBlank())->assert([1]);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
The value must not be blank
Field must not be blank
1 must be blank
- The value must not be blank
- Field must not be blank
- `{ 1 }` must be blank
