--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\CharsetException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::charset('ASCII')->check('açaí');
} catch (CharsetException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::charset('UTF-8'))->check('açaí');
} catch (CharsetException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::charset('ASCII')->assert('açaí');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::charset('UTF-8'))->assert('açaí');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}
?>
--EXPECTF--
"açaí" must be in the `{ "ASCII" }` charset
"açaí" must not be in the `{ "UTF-8" }` charset
- "açaí" must be in the `{ "ASCII" }` charset
- "açaí" must not be in the `{ "UTF-8" }` charset
