--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

exceptionMessage(static fn() => v::regex('/^w+$/')->check('w poiur'));
exceptionMessage(static fn() => v::not(v::regex('/^[a-z]+$/'))->check('wpoiur'));
exceptionFullMessage(static fn() => v::regex('/^w+$/')->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::regex('/^[a-z]+$/i'))->assert('wPoiur'));
?>
--EXPECT--
"w poiur" must validate against "/^w+$/"
"wpoiur" must not validate against "/^[a-z]+$/"
- `[object] (stdClass: { })` must validate against "/^w+$/"
- "wPoiur" must not validate against "/^[a-z]+$/i"
