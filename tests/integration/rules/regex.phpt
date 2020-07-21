--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\RegexException;
use Respect\Validation\Validator as v;

try {
    v::regex('/^w+$/')->check('w poiur');
} catch (RegexException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::regex('/^[a-z]+$/'))->check('wpoiur');
} catch (RegexException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::regex('/^w+$/')->assert(new stdClass());
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::regex('/^[a-z]+$/i'))->assert('wPoiur');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
"w poiur" must validate against "/^w+$/"
"wpoiur" must not validate against "/^[a-z]+$/"
- `[object] (stdClass: { })` must validate against "/^w+$/"
- "wPoiur" must not validate against "/^[a-z]+$/i"
