--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::regex('/^w+$/')->assert('w poiur'));
exceptionMessage(static fn() => v::not(v::regex('/^[a-z]+$/'))->assert('wpoiur'));
exceptionFullMessage(static fn() => v::regex('/^w+$/')->assert(new stdClass()));
exceptionFullMessage(static fn() => v::not(v::regex('/^[a-z]+$/i'))->assert('wPoiur'));
?>
--EXPECT--
"w poiur" must validate against `/^w+$/`
"wpoiur" must not validate against `/^[a-z]+$/`
- `stdClass {}` must validate against `/^w+$/`
- "wPoiur" must not validate against `/^[a-z]+$/i`
