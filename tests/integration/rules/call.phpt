--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CallException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

try {
    v::call('trim', v::noWhitespace())->check(' two words ');
} catch (ValidationException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::call('trim', v::stringType()))->check(' something ');
} catch (CallException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::call('trim', v::alwaysValid())->check([]);
} catch (ValidationException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::call('strval', v::intType())->assert(1234);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::call('is_float', v::boolType()))->assert(1.2);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::call('array_walk', v::alwaysValid())->assert(INF);
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECT--
"two words" must not contain whitespace
" something " must not be valid when executed with "trim"
`{ }` must be valid when executed with "trim"
- "1234" must be of type integer
- 1.2 must not be valid when executed with "is_float"
- `INF` must be valid when executed with "array_walk"
