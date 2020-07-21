--CREDITS--
Michael Weimann <mail@michael-weimann.eu>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\UuidException;
use Respect\Validation\Validator as v;

try {
    v::uuid()->check('g71a18f4-3a13-11e7-a919-92ebcb67fe33');
} catch (UuidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::uuid(1)->check('e0b5ffb9-9caf-2a34-9673-8fc91db78be6');
} catch (UuidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::uuid())->check('fb3a7909-8034-59f5-8f38-21adbc168db7');
} catch (UuidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::uuid(3))->check('11a38b9a-b3da-360f-9353-a5a725514269');
} catch (UuidException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::uuid()->assert('g71a18f4-3a13-11e7-a919-92ebcb67fe33');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::uuid(4)->assert('a71a18f4-3a13-11e7-a919-92ebcb67fe33');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::uuid())->assert('e0b5ffb9-9caf-4a34-9673-8fc91db78be6');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::uuid(5))->assert('c4a760a8-dbcf-5254-a0d9-6a4474bd1b62');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID
"e0b5ffb9-9caf-2a34-9673-8fc91db78be6" must be a valid UUID version 1
"fb3a7909-8034-59f5-8f38-21adbc168db7" must not be a valid UUID
"11a38b9a-b3da-360f-9353-a5a725514269" must not be a valid UUID version 3
- "g71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID
- "a71a18f4-3a13-11e7-a919-92ebcb67fe33" must be a valid UUID version 4
- "e0b5ffb9-9caf-4a34-9673-8fc91db78be6" must not be a valid UUID
- "c4a760a8-dbcf-5254-a0d9-6a4474bd1b62" must not be a valid UUID version 5
